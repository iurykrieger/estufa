<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Scan;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScanController extends Controller
{
    /**
     * Display a listing of the scans.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scans = Scan::take(100)->get();
        return view('scans.index',['scans' => $scans, 'user' => Auth::user()]);
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
