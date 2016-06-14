<?php

namespace App\Services;

use App\Scan;
use DB;

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
            ->whereBetween('date', array($initialDate,$finalDate))
    		->where('id_sensor', '=', $sensor)
    		->where('temperature', '<', 100)
            ->where('temperature', '>', -20)
    		->groupBy('temperature','air_humidity','ground_humidity')
    		->get();
        //dd($scans);
    	//echo($scans);
        //exit;
    	return $scans;
    }
}
/*
    public static function getScansBySensor($initialDate, $finalDate, $sensor){
          $scans = DB::table('scans')
                ->select((DB::raw('data_alterada, temperature, air_humidity, ground_humidity
FROM
    (SELECT 
        DATE_FORMAT(CONCAT(DATE, CONCAT(" ", time)), "%Y-%m-%d %H:%i") AS data_alterada,
            temperature,
            air_humidity,
            ground_humidity
    FROM
        scans) AS a')))
                ->whereBetween('data_alterada', array($initialDate,$finalDate))
                ->where('id_sensor', '=', $sensor)
                ->where('temperature', '<', 100)
                ->where('temperature', '>', -20)
                ->groupBy('temperature','air_humidity','ground_humidity')
                ->get();
        dd($scans);
        //echo($scans);
        //exit;
        return $scans;
    }
}*/