<?php

namespace App\Services;

use App\Scan;

class DataTransfer
{
    public static function getScansByAmbient($initialDate, $finalDate, $ambient){
    	$scans = Scan::orderBy('date','desc')
    		->orderBy('time','desc')
    		->where('id_ambient', '=', $ambient)
    		->whereBetween('date', array($initialDate,$finalDate))
    		->get();
    	dd($scans);

    	return $scans;
    }

    public static function getScansBySensor($initialDate, $finalDate, $sensor){

    	$scans = Scan::orderBy('date','desc')
    		->orderBy('time','desc')
    		->where('id_sensor', '=', $sensor)
    		->whereBetween('date', array($initialDate,$finalDate))
    		->groupBy('temperature','air_humidity','ground_humidity')
    		->get();

    	//dd($scans);
    	return $scans;
    }
}
