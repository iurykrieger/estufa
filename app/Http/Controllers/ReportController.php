<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

use JasperPHP\JasperPHP;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexScan()
    {
        return view('reports/reportScan');
    }
 
 
    public function postScan()
    {
        $jasper = new JasperPHP();

        $database = Config::get('database.connections.mysql');
        $output = public_path() . '/report/'.'RelatorioLeituras_' . time();
        $outputExt = "pdf";
        $report = public_path() . '/report/ScanReport.jasper';

        $jasper->process(
            $report, //Relatório de entrada
            $output, //Relatório de saída
            array($outputExt), //Formato de saída
            array('SENSOR' => '3'), //Parâmetros
            $database //Conexão com o banco
        )->execute();
 
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.'RelatorioLeituras_' . time(). '.'.$outputExt);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($output.'.'.$outputExt));
        flush();
        readfile($output.'.'.$outputExt);
        unlink($output.'.'.$outputExt); // deletes the temporary file
        
        return Redirect::to('/admin/report/scan');
    }
}
