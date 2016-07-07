<?php

namespace App\Http\Controllers; 

use App\Ambient;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use JasperPHP\Facades\JasperPHP;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexScan()
    {
        $ambients = Ambient::all();
        $sensors = Sensor::all();
        return view('reports/reportScan', ['ambients' => $ambients, 'sensors' => $sensors]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAmbient()
    {
        return view('reports/reportAmbient');
    }
 
    /**
     * Receive Post Request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postScan(Request $request)
    {
        /**
         * Get request inputs
         */
        $initialDate = $request->input('initialDate');
        $endDate = $request->input('endDate');
        $sensor = $request->input('sensor');
        $ambient = $request->input('ambient');
        $limit = $request->input('limit');

        $params = array();

        if(!empty($sensor)){
            $params['SENSOR'] = $sensor;
        }
        if(!empty($ambient)){
            $params['AMBIENT'] = $ambient;
        }
        if(!empty($initialDate)){
            $params['INITIAL_DATE'] = $initialDate; 
        }
        if(!empty($endDate)){
            $params['END_DATE'] = $endDate;
        }
        if(!empty($limit)){
            $params['LIMIT'] = '"LIMIT ' .  $limit . '"';   
        }

        /**
         * Process the report
         */
        return $this->generateReport('ScanReport', 'RelatorioLeituras', $params);

        return Redirect::to('/admin/report/scan');
    }

    /**
     * Receive Post Request
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postAmbient(Request $request)
    {
        /**
         * Get request inputs
         */
        $initialDate = $request->input('initialDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit');

        $params = array();

        if(!empty($initialDate)){
            $params['INITIAL_DATE'] = $initialDate; 
        }
        if(!empty($endDate)){
            $params['END_DATE'] = $endDate;
        }
        if(!empty($limit)){
            $params['LIMIT'] = '"LIMIT ' .  $limit . '"';   
        }

        /**
         * Process the report
         */
        return $this->generateReport('AmbientReport', 'RelatorioAmbientes', $params);

        return Redirect::to('/admin/report/ambient');
    }



    /**
     * Process and generates the report
     * @param  [type] $reportName  [description]
     * @param  [type] $reportAlias [description]
     * @param  [type] $params      [description]
     * @return [type]              [description]
     */
    private function generateReport($reportName, $reportAlias, $params){
        
        $database = Config::get('database.connections.mysql');
        $outputExt = "pdf";
        $outputName = $reportAlias . '_' . time();
        $outputPath = public_path() . '/report/'. $outputName;
        $report = public_path() . '/report/'. $reportName . '.jasper';

        JasperPHP::process(
            $report, //Relatório de entrada
            $outputPath, //Relatório de saída
            array($outputExt), //Formato de saída
            $params, //Parâmetros
            $database //Conexão com o banco
        )->execute();

        header("Content-type: application/octet-stream");                       
        header("Content-Disposition:inline;filename='".$outputName.'.'.$outputExt."'");            
        header('Content-Length: ' . filesize($outputPath.'.'.$outputExt));
        header("Cache-control: private"); //use this to open files directly
        flush();
        readfile($outputPath.'.'.$outputExt);
        unlink($outputPath.'.'.$outputExt); // deletes the temporary file*/
    }
}
