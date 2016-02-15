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

class AmbientController extends Controller
{

    /**
     * Instantiate a new AmbientController instance.
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
        $ambients = Ambient::orderBy('updated_at','desc')->paginate(20);
        return view('ambients.index',['ambients' => $ambients]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ambients.create');
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
            'max_temperature' => 'required',
            'min_temperature' => 'required',
            'max_air_humidity' => 'required',
            'min_air_humidity' => 'required',
            'max_ground_humidity' => 'required',
            'min_ground_humidity' => 'required'
            ]);
        $ambient = $request->all();
        Ambient::create($ambient);

        return Redirect::to('admin/ambient/create')->with('successMessage','O ambiente foi cadastrado com sucesso no banco de dados.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ambient = Ambient::findOrFail($id);
        return view('ambients.show',['ambient' => $ambient]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ambient = Ambient::findOrFail($id);
        return view('ambients.edit', ['ambient' => $ambient]);
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
        $ambient = Ambient::findOrFail($id);

        $this->validate($request, [
            'description' => 'required',
            'max_temperature' => 'required',
            'min_temperature' => 'required',
            'max_air_humidity' => 'required',
            'min_air_humidity' => 'required',
            'max_ground_humidity' => 'required',
            'min_ground_humidity' => 'required'
            ]);

        $input = $request->all();
        $ambient->fill($input)->save();

        return Redirect::to('admin/ambient/'.$ambient->id_ambient)->with('successMessage','O ambiente foi alterado com sucesso no banco de dados.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ambient = Ambient::findOrFail($id);
        Sensor::where('id_ambient', $ambient->id_ambient)->delete();
        $ambient->delete();
        return Redirect::to('admin/ambient')->with('successMessage','O ambiente foi excluido com sucesso do banco de dados.');
    }
}
