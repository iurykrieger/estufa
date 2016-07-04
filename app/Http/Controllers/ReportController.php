<?php

namespace App\Http\Controllers; 

use App\Ambient;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
        $this->generateReport('ScanReport', 'RelatorioLeituras', $params);

        return Redirect::to('/admin/report/scan');
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
        $output = public_path() . '/report/'. $reportAlias . '_' . time();
        $outputExt = "pdf";
        $report = public_path() . '/report/'. $reportName . '.jasper';

        JasperPHP::process(
            $report, //Relatório de entrada
            $output, //Relatório de saída
            array($outputExt), //Formato de saída
            $params, //Parâmetros
            $database //Conexão com o banco
        )->execute();
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='. $reportAlias . '_' . time(). '.'.$outputExt);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($output.'.'.$outputExt));
        flush();
        readfile($output.'.'.$outputExt);
        unlink($output.'.'.$outputExt); // deletes the temporary file
    }
}
