<?php

namespace App\Http\Controllers;

use App\Ambient;
use App\GhostScan;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LastScan;
use App\Scan;
use App\Sensor;
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
        return view('sensors.index',['sensors' => $sensors, 'user' => Auth::user()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ambients = Ambient::lists('description', 'id_ambient');
        return view('sensors.create',['ambients' => $ambients, 'user' => Auth::user()]);
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
        return view('sensors.show',['sensor' => $sensor, 'user' => Auth::user()]);
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
        return view('sensors.edit', ['sensor' => $sensor, 'ambients' => $ambients , 'user' => Auth::user()]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $sensor = Sensor::findOrFail($id);
        GhostScan::where('id_sensor', $sensor->id_sensor)->delete();
        Scan::where('id_sensor', $sensor->id_sensor)->delete();
        LastScan::where('id_sensor', $sensor->id_sensor)->delete();
        $sensor->delete();

        return Redirect::to('admin/sensor')->with('successMessage','O sensor foi excluido com sucesso do banco de dados.');
    }
}
