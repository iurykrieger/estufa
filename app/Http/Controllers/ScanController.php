<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Scan;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ScanController extends Controller
{
    /**
     * Display a listing of the scans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($pagesize = 25){
        $sizes = [10,25,50,100,150];
        $scans = Scan::orderBy('date','desc')->orderBy('time','desc')->paginate($pagesize);
        return view('scans.scans',['scans' => $scans, 'pagesize' => $pagesize, 'sizes' => $sizes ,'user' => Auth::user()]);
    }

    /**
     * Display the specified scan.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified scans by id_sensor
     * @param  App\Sensor $idSensor [id of the sensor]
     * @return Collection of App\Scan
     */
    public function showBySensor($idSensor){
        $sensor = Sensor::findOrFail($idSensor);
        $scans = $sensor->scans;
        return view('scans.showBySensor',['scans' => $scans, 'user' => Auth::user()]);
    }
}
