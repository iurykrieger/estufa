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
        $scans = DataTransfer::getScansBySensor('2016-04-25', Carbon::now(), 1)->all();

        $dt ->addDateColumn('Data')
            ->addNumberColumn('Temperatura')
            ->addNumberColumn('Umidade Ar')
            ->addNumberColumn('Umidade Solo');

        foreach($scans as $scan){
            $dt->addRow([$scan->date,  $scan->temperature, $scan->air_humidity, $scan->ground_humidity]);
        }

        //dd($scans[0]->date);

        $grafico = Lava::LineChart('grafico', $dt, [
           'height' => 600,
           'hAxis' => [
                'title' => 'Data',
                'format' => 'dd-MMMM-yyyy',
                'viewWindowMode' => 'explicit',
                'viewWindow' => [
                    'min' => 20160101,
                    'max' => 20160503
                ]
            ],
            'vAxis' => [
                'title' => 'Temperatura'
            ]
        ]);
          

        return view('chart.scans',['user'=>Auth::user()]);
    }

}
/*
    <div class="form-group">
    {!! Form::label('id_sensor', 'Sensor:', ['class' => 'control-label']) !!}
    {!! Form::select('id_sensor', null, null, ['class' => 'form form-control']) !!}
    </div>

    <div class="form-group">
    {!! Form::label('id_ambient', 'Ambientes:', ['class' => 'control-label']) !!}
    {!! Form::select('id_ambient', $ambients, null, ['class' => 'form form-control']) !!}
    </div>
**/