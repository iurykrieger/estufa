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
use Illuminate\Support\Facades\Validator;
use Khill\Lavacharts\Laravel\LavachartsFacade as Lava;
use Illuminate\Support\Facades\Session;

class ChartController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $ambients = Ambient::all();
        $sensors = Sensor::all();

        return view('chart/scans', ['user'=>Auth::user(),'ambients' => $ambients, 'sensors' => $sensors]);
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
        $temperatura = $request->input('temperature');
        $uda = $request->input('air_humidity');
        $uds = $request->input('ground_humidity');

        $params = array();

        if(!empty($sensor))      $params['SENSOR'] = $sensor; 
        if(!empty($ambient))     $params['AMBIENT'] = $ambient; 
        if(!empty($initialDate)) $params['INITIAL_DATE'] = $initialDate; 
        if(!empty($endDate))     $params['END_DATE'] = $endDate; 
      
        /* 
        if(empty($sensor) &&  empty($ambient))// busca apenas por data  
           $scans = DataTransfer::getScansBySensor($initialDate, $endDate, $sensor, $ambient);  

        if(!empty($sensor) &&  empty($ambient))// busca apenas por sensor  
            $scans = DataTransfer::getScansBySensor($initialDate, $endDate, $sensor, $ambient);           

        if(empty($sensor)  && !empty($ambient))// busca apenas por ambiente  
            $scans = DataTransfer::getScansByAmbient($initialDate, $endDate, $sensor, $ambient);        
        */
        if(!empty($sensor) && !empty($ambient))// busca completa (sensor e ambiente)
             $scans = DataTransfer::getScansBySensorAndAmbient($initialDate, $endDate, $sensor, $ambient);


        /**
         * Cria a data table - adiciona as colunas e carrega dados
         */
        $dt = Lava::DataTable();

        //Carrega somente temperatura
        if(!empty($temperatura) && empty($uda) && empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Temperatura');
            foreach($scans as $scan){  $dt->addRow([$scan->data_alterada, $scan->temperature]);  }
        }

        //Carrega somente umidade do ar
        if(empty($temperatura) && !empty($uda) && empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Umidade Ar');
            foreach($scans as $scan){ $dt->addRow([$scan->data_alterada, $scan->air_humidity]);  }
        }

        //Carrega somente umidade do solo
        if(empty($temperatura) && empty($uda) && !empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Umidade Solo');
            foreach($scans as $scan){  $dt->addRow([$scan->data_alterada,$scan->ground_humidity]); }
        }

        //Carrega temperatura e umidade do ar
        if(!empty($temperatura) && !empty($uda) && empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Temperatura')->addNumberColumn('Umidade Ar');
            foreach($scans as $scan){ $dt->addRow([$scan->data_alterada, $scan->temperature, $scan->air_humidity]);}
        }

        //Carrega temperatura e umidade do solo
        if(!empty($temperatura) && empty($uda) && !empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Temperatura')->addNumberColumn('Umidade Solo');
            foreach($scans as $scan){ $dt->addRow([$scan->data_alterada, $scan->temperature, $scan->ground_humidity]);}
        }

        //Carrega umidade do ar e umidade do solo
        if(empty($temperatura) && !empty($uda) && !empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Umidade Ar')->addNumberColumn('Umidade Solo');
            foreach($scans as $scan){ $dt->addRow([$scan->data_alterada, $scan->air_humidity, $scan->ground_humidity]);}
         }

        //Carrega todos os dados no grafico
        if(!empty($temperatura) && !empty($uda) && !empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Temperatura')->addNumberColumn('Umidade Ar')->addNumberColumn('Umidade Solo');
            foreach($scans as $scan){ $dt->addRow([$scan->data_alterada, $scan->temperature, $scan->air_humidity, $scan->ground_humidity]); }            
        }

        //Caso nenhuma check fique marcado, consulta por todas as opcoes
        if(empty($temperatura) && empty($uda) && empty($uds)){
            $dt ->addDateTimeColumn('Data')->addNumberColumn('Temperatura')->addNumberColumn('Umidade Ar')->addNumberColumn('Umidade Solo');
            foreach($scans as $scan){ $dt->addRow([$scan->data_alterada, $scan->temperature, $scan->air_humidity, $scan->ground_humidity]); }            
        }

        if(empty($scan)){
            Session::flash('warningMessage','Nenhuma leitura encontrada.');
            $grafico = Lava::LineChart('grafico', $dt, [
                   'height' => 600,
                   'hAxis' => [                
                        'title' => 'Data'
                    ],
                    'vAxis' => [
                        'title' => 'Temperatura'                
                    ]
                ]);            
        }else{
            $grafico = Lava::LineChart('grafico', $dt, [
                   'height' => 600,
                   'hAxis' => [                
                        'title' => 'Data'
                    ],
                    'vAxis' => [
                        'title' => 'Temperatura'                
                    ]
                ]);
            }

        return view('chart/scans',['user'=>Auth::user(),'ambients' => $ambients, 'sensors' => $sensors]);

     }
    
}

