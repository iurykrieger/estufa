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
        $unregistered_sensors = DataTransfer::getLastUnregisteredSensorScans();
        return view('sensors.index',['sensors' => $sensors, 'unregistered_sensors' => $unregistered_sensors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if(Auth::user()->isAdmin()){
            $ambients = Ambient::lists('description', 'id_ambient');
            if($id != null){
                return view('sensors.create',['ambients' => $ambients, 'real_id' => $id]); 
            }else{
                return view('sensors.create',['ambients' => $ambients]);
            }
        }else{
            return Redirect::back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->isAdmin()){
            $this->validate($request, [
                'description' => 'required|alpha_num',
                'id_ambient' => 'required|integer',
                'active' => 'required|boolean'
                ]);
            $sensor = $request->all();
            $savedSensor = Sensor::create($sensor);
            
            if(!isset($request->real_id)){
                $savedSensor->real_id = $savedSensor->id_sensor;
            }else{
                $savedSensor->real_id = $request->real_id;
            }

            $savedSensor->save();

            DataTransfer::transferGhostToScans($savedSensor);
            
            return Redirect::to('admin/sensor/create')->with('successMessage','O sensor foi cadastrado com sucesso no banco de dados.');
        }else{
            return Redirect::back();
        }
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
        if(Auth::user()->isAdmin()){
            $sensor = Sensor::findOrFail($id);
            $ambients = Ambient::lists('description', 'id_ambient');
            return view('sensors.edit', ['sensor' => $sensor, 'ambients' => $ambients]);
        }else{
            return Redirect::back();
        }
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
        if(Auth::user()->isAdmin()){
            $sensor = Sensor::findOrFail($id);

            $this->validate($request, [
                'description' => 'required|alpha_num',
                'id_ambient' => 'required|integer',
                'active' => 'required|boolean'
                ]);

            $input = $request->all();

            if($sensor->id_ambient == null){
                $sensor->fill($input)->save();
                DataTransfer::transferGhostToScans(Sensor::findOrFail($sensor->id_sensor));
            }else{
                $sensor->fill($input)->save();
            }

            return Redirect::to('admin/sensor/'.$sensor->id_sensor)->with('successMessage','O sensor foi alterado com sucesso no banco de dados.');
        }else{
            return Redirect::back();
        }
    }

    /**
     * Remove the ambient from specified sensor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(Auth::user()->isAdmin()){
            $sensor = Sensor::findOrFail($id);
            $sensor->active = false;
            $sensor->id_ambient = null;
            $sensor->save();

            return Redirect::back()->with('successMessage','O sensor foi removido do ambiente com sucesso.');
        }else{
            return Redirect::back();
        }
    }

    /**
     * Deactivate the specified sensor
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function deactivate($id){
        if(Auth::user()->isAdmin()){
            $sensor = Sensor::findOrFail($id);
            $sensor->active = false;
            $sensor->save();
        
            return Redirect::back()->with('successMessage','O sensor foi desativado com sucesso.');
        }else{
            return Redirect::back();
        }
    }

    /**
     * Activate the specified sensor
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function activate($id){
        if(Auth::user()->isAdmin()){
            $sensor = Sensor::findOrFail($id);
            if(!(is_null($sensor->ambient))){
                $sensor->active = true;
                $sensor->save();
                return Redirect::back()->with('successMessage','O sensor foi desativado com sucesso.');
            }else{
                return Redirect::back()->withErrors(['O sensor precisa ter um ambiente atrelado para ser ativado!']);
            }
        }else{
            return Redirect::back();
        }
    }

    public function multipleDestroy(Request $request){
        if(Auth::user()->isAdmin()){
            $sensors = $request->sensors;
            foreach ($sensors as $id) {
                $sensor = Sensor::findOrFail($id);
                $sensor->active = false;
                $sensor->id_ambient = null;
                $sensor->save();
            }
            return Redirect::back()->with('successMessage','Sensores desativados com sucesso.');
        }else{
            return Redirect::back();
        }
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
