<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chart;
use App\Sensor;
use App\Ambient;
use App\Scan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;

class ChartController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    public function showSensor(){
         $sensors = Sensor::all();
         $sizes = [10,25,50,100,150];
         $scans = Scan::orderBy('date','desc')->orderBy('time','desc')->where('id_scan', '>', 316000)->get();
         return view('chart.sensor',['scans' => $scans,'sensors' => $sensors,'user'=>Auth::user()]);
    }

    public function showAmbient(){

    $temperatures = Lava::DataTable();

    $scans = Scan::orderBy('date','asc')->orderBy('time','asc')->paginate(4000);

    $temperatures->addDateColumn('Date')
    ->addNumberColumn('Temperatura')
    ->addNumberColumn('Umidade ar')
    ->addNumberColumn('Umidade solo');

    foreach ($scans as $scan) {
        $temperatures->addRow([$scan->date,$scan->temperature,$scan->air_humidity,$scan->ground_humidity]);
    }

    
    Lava::LineChart('Temps', $temperatures, [
        'title' => 'Weather in October',
        'height'=> 800
        ]);

    return view('chart.ambient',['user'=>Auth::user()]);
    }
}
