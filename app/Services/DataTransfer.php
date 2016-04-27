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
}
