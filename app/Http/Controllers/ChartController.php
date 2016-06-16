<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Chart;
use App\Sensor;
use App\Ambient;
use App\Scan;
use App\Services\DataTransfer;
use Carbon\Carbon;


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
        //
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

    /**
     * Show SensorChart
     *
     * @return \resources\views\chart\sensor.blade.php
     */
    public function showChart(){
        $dt = Lava::DataTable();
        $scans = DataTransfer::getScansBySensor('2016-04-23', '2016-04-25', 1);

        $dt ->addDateTimeColumn('Data')
            ->addNumberColumn('Temperatura')
            ->addNumberColumn('Umidade Ar')
            ->addNumberColumn('Umidade Solo');

        foreach($scans as $scan){
            $dt->addRow([$scan->time, $scan->temperature, $scan->air_humidity, $scan->ground_humidity]);
        }

        $grafico = Lava::LineChart('grafico', $dt, [
           'height' => 600,
           'hAxis' => [                
                'title' => 'Data'
            ],
            'vAxis' => [
                'title' => 'Temperatura'                
            ]
        ]);
        
        $sensores = Sensor::lists('id_sensor','description');
        $ambients = Ambient::lists('id_ambient', 'description');

         return view('chart.scans',['user'=>Auth::user(),'sensores'=> $sensores, 'ambientes' => $ambients]);
    }

}
