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
        $ambients = Ambient::all();
        $sensors = Sensor::all();

        $dt = Lava::DataTable();
        $dt ->addDateTimeColumn('Data')
            ->addNumberColumn('Temperatura')
            ->addNumberColumn('Umidade Ar')
            ->addNumberColumn('Umidade Solo');
        $grafico = Lava::LineChart('grafico', $dt, [
           'height' => 600,
           'hAxis' => [                
                'title' => 'Data'
            ],
            'vAxis' => [
                'title' => 'Temperatura'                
            ]
        ]);

        return view('chart/scans', ['user'=>Auth::user(),'ambients' => $ambients, 'sensors' => $sensors, 'grafico' => $grafico]);
    }


    /**
     * Display chart.
     *
     * @return \Illuminate\Http\Response
     */
    public function postChart(Request $request){
        $ambients = Ambient::all();
        $sensors = Sensor::all();

         /**
         * Valida os campos
         */
        $this->validate($request, [
            'sensor' => 'required',
            'ambient' => 'required',
            'endDate' => 'required',
            'initialDate' => 'required'
        ]);

        /**
         * Retorna paramentros da pagina
         */
        $initialDate = $request->input('initialDate');
        $endDate = $request->input('endDate');
        $sensor = $request->input('sensor');
        $ambient = $request->input('ambient');

        $params = array();

        if(!empty($sensor))      $params['SENSOR'] = $sensor; 
        if(!empty($ambient))     $params['AMBIENT'] = $ambient; 
        if(!empty($initialDate)) $params['INITIAL_DATE'] = $initialDate; 
        if(!empty($endDate))     $params['END_DATE'] = $endDate; 
      
         
        if(empty($sensor) &&  empty($ambient))// busca apenas por data  
           $scans = DataTransfer::getScansBySensor($initialDate, $endDate, $sensor, $ambient);  

        if(!empty($sensor) &&  empty($ambient))// busca apenas por sensor  
            $scans = DataTransfer::getScansBySensor($initialDate, $endDate, $sensor, $ambient);           

        if(empty($sensor)  && !empty($ambient))// busca apenas por ambiente  
            $scans = DataTransfer::getScansByAmbient($initialDate, $endDate, $sensor, $ambient);        
          
        if(!empty($sensor) && !empty($ambient))// busca completa (sensor e ambiente)
             $scans = DataTransfer::getScansBySensorAndAmbient($initialDate, $endDate, $sensor, $ambient);


        /**
         * Cria a data table - adiciona as colunas e carrega dados
         */
        $dt = Lava::DataTable();

        $dt ->addDateTimeColumn('Data')
            ->addNumberColumn('Temperatura')
            ->addNumberColumn('Umidade Ar')
            ->addNumberColumn('Umidade Solo');

        foreach($scans as $scan){
            $dt->addRow([$scan->data_alterada, $scan->temperature, $scan->air_humidity, $scan->ground_humidity]);
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

         return view('chart.scans',['user'=>Auth::user(),'ambients' => $ambients, 'sensors' => $sensors,]);
    }
}

