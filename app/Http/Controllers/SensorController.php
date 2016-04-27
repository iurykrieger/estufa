<?php

namespace App\Http\Controllers;

use App\Ambient;
use App\GhostScan;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LastScan;
use App\Scan;
use App\Sensor;
use App\Services\DataTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SensorController extends Controller
{

    /**
     * Instantiate a new SensorController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensors = Sensor::orderBy('updated_at','desc')->paginate(20);
        return view('sensors.index',['sensors' => $sensors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ambients = Ambient::lists('description', 'id_ambient');
        return view('sensors.create',['ambients' => $ambients]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'id_ambient' => 'required',
            'active' => 'required'
            ]);
        $sensor = $request->all();
        Sensor::create($sensor);

        return Redirect::to('admin/sensor/create')->with('successMessage','O sensor foi cadastrado com sucesso no banco de dados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sensor = Sensor::findOrFail($id);
        return view('sensors.show',['sensor' => $sensor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);
        $ambients = Ambient::lists('description', 'id_ambient');
        return view('sensors.edit', ['sensor' => $sensor, 'ambients' => $ambients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sensor = Sensor::findOrFail($id);

        $this->validate($request, [
            'description' => 'required',
            'id_ambient' => 'required',
            'active' => 'required'
            ]);

        $input = $request->all();
        $sensor->fill($input)->save();

        return Redirect::to('admin/sensor/'.$sensor->id_sensor)->with('successMessage','O sensor foi alterado com sucesso no banco de dados.');
    }

    /**
     * Remove the ambient from specified sensor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $sensor = Sensor::findOrFail($id);
        $sensor->active = false;
        $sensor->id_ambient = null;
        $sensor->save();

        return Redirect::back()->with('successMessage','O sensor foi removido do ambiente com sucesso.');
    }

    /**
     * Deactivate the specified sensor
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id){
        $sensor = Sensor::findOrFail($id);
        $sensor->active = false;
        $sensor->save();
    
        return Redirect::back()->with('successMessage','O sensor foi desativado com sucesso.');
    }

    /**
     * Activate the specified sensor
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id){
        $sensor = Sensor::findOrFail($id);
        if(!(is_null($sensor->ambient))){
            $sensor->active = true;
            $sensor->save();
            return Redirect::back()->with('successMessage','O sensor foi desativado com sucesso.');
        }else{
            return Redirect::back()->withErrors(['O sensor precisa ter um ambiente atrelado para ser ativado!']);
        }
    }

    public function multipleDestroy(Request $request){
        $sensors = $request->sensors;
        foreach ($sensors as $id) {
            $sensor = Sensor::findOrFail($id);
            $sensor->active = false;
            $sensor->id_ambient = null;
            $sensor->save();
        }
        return Redirect::back()->with('successMessage','Sensores desativados com sucesso.');
    }

    /**
     * Get All Sensors of the specified Ambient
     * @param  int $id [Ambient Id]
     * @return [type]     [description]
     */
    public function getSensorsByAmbient($id = null){
        if($id == null){
            $id = Ambient::first()->id_ambient;
        }
        $ambients = Ambient::all();
        $selectedAmbient = Ambient::findOrFail($id);
        $sensors = $selectedAmbient->sensors()->paginate(30);
        return view('sensors.indexByAmbient',['selectedAmbient' => $selectedAmbient, 'ambients' => $ambients, 'sensors' => $sensors]);
    }
}
