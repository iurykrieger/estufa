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

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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

        $temperatures->addDateColumn('Date')
                     ->addNumberColumn('Max Temp')
                     ->addNumberColumn('Mean Temp')
                     ->addNumberColumn('Min Temp')
                     ->addRow(['2014-10-1',  67, 65, 62])
                     ->addRow(['2014-10-2',  68, 65, 61])
                     ->addRow(['2014-10-3',  68, 62, 55])
                     ->addRow(['2014-10-4',  72, 62, 52])
                     ->addRow(['2014-10-5',  61, 54, 47])
                     ->addRow(['2014-10-6',  70, 58, 45])
                     ->addRow(['2014-10-7',  74, 70, 65])
                     ->addRow(['2014-10-8',  75, 69, 62])
                     ->addRow(['2014-10-9',  69, 63, 56])
                     ->addRow(['2014-10-10', 64, 58, 52])
                     ->addRow(['2014-10-11', 59, 55, 50])
                     ->addRow(['2014-10-12', 65, 56, 46])
                     ->addRow(['2014-10-13', 66, 56, 46])
                     ->addRow(['2014-10-14', 75, 70, 64])
                     ->addRow(['2014-10-15', 76, 72, 68])
                     ->addRow(['2014-10-16', 71, 66, 60])
                     ->addRow(['2014-10-17', 72, 66, 60])
                     ->addRow(['2014-10-18', 63, 62, 62]);
    
    Lava::LineChart('Temps', $temperatures, [
    'title' => 'Weather in October'
    ]);

        return view('chart.ambient',['user'=>Auth::user()]);
    }
}
