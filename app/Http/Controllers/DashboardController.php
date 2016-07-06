<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Lava;
use App\Http\Requests;
use App\Services\DataTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Instantiate a new DashboardController instance.
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
        $todayScanCount = DataTransfer::getTodayScanCount();
        $todayScanAvgs = DataTransfer::getTodayScanAvgs();

        $scans = DataTransfer::getTodayScans();
        $dt = \Lava::DataTable();
        $dt ->addDateTimeColumn('Data')->addNumberColumn('Temperatura')->addNumberColumn('Umidade Ar')->addNumberColumn('Umidade Solo');
            
        foreach($scans as $scan){ 
            $dt->addRow([$scan->data_alterada, $scan->temperature, $scan->air_humidity, $scan->ground_humidity]);
        }

        \Lava::LineChart('todayScans', $dt, [
                   'height' => 620,
                   'hAxis' => [                
                        'title' => 'Data'
                    ],
                    'vAxis' => [
                        'title' => 'Temperatura'                
                    ]
                ]);
            
        // last inserted sensors
        $lastSensors = DataTransfer::getLastInsertedSensors();
        $lastAmbients = DataTransfer::getLastInsertedAmbients();
        $avgAmbients = DataTransfer::getAmbientAVG();

        //Sensors without ambient
        $sensorsWithoutAmbient = DataTransfer::getSensorsWithoutAmbient();


        return view('index',['todayScanCount' => $todayScanCount, 
                             'todayScanAvgs' => $todayScanAvgs, 
                             'lastSensors' => $lastSensors, 
                             'lastAmbients' => $lastAmbients, 
                             'avgAmbients' => $avgAmbients,
                             'sensorsWithoutAmbient' => $sensorsWithoutAmbient]);
    }

}
