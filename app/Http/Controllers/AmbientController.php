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
use Illuminate\Support\Facades\Session;

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
        if(Auth::user()->isAdmin()){
            return view('ambients.create');
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
                'max_temperature' => 'required|numeric|min:-100|max:100',
                'min_temperature' => 'required|numeric|min:-100|max:100',
                'max_air_humidity' => 'required|numeric|min:0|max:100',
                'min_air_humidity' => 'required|numeric|min:0|max:100',
                'max_ground_humidity' => 'required|numeric|min:0|max:100',
                'min_ground_humidity' => 'required|numeric|min:0|max:100'
                ]);
            $ambient = $request->all();
            Ambient::create($ambient);
            return Redirect::to('admin/ambient/create')->with('successMessage','O ambiente foi cadastrado com sucesso no banco de dados.');
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
        if(Auth::user()->isAdmin()){
            $ambient = Ambient::findOrFail($id);
            return view('ambients.edit', ['ambient' => $ambient]);
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
            $ambient = Ambient::findOrFail($id);

            $this->validate($request, [
                'description' => 'required|alpha_num',
                'max_temperature' => 'required|numeric|min:-100|max:100',
                'min_temperature' => 'required|numeric|min:-100|max:100',
                'max_air_humidity' => 'required|numeric|min:0|max:100',
                'min_air_humidity' => 'required|numeric|min:0|max:100',
                'max_ground_humidity' => 'required|numeric|min:0|max:100',
                'min_ground_humidity' => 'required|numeric|min:0|max:100'
                ]);

            $input = $request->all();
            $ambient->fill($input)->save();

            return Redirect::to('admin/ambient/'.$ambient->id_ambient)->with('successMessage','O ambiente foi alterado com sucesso no banco de dados.');
        }else{
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->isAdmin()){
            $ambient = User::findOrFail($id);
            if(count($ambient->sensors()) > 0){
                return Redirect::back()->withErrors('Você não pode deletar um ambiente que possui sensores atrelados!');
            }else{
                $ambient->delete();
                return Redirect::to('admin/ambient')->with('successMessage','O ambiente foi excluido com sucesso do banco de dados.');
            }
        }else{
            return Redirect::back();
        }
    }
}
