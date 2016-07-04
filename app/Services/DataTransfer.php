<?php

namespace App\Services;

use App\Scan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataTransfer
{
    public static function getScansByDate($initialDate, $finalDate){
        $sub = DB::table('scans')->selectRaw('DATE_FORMAT(CONCAT(DATE," ",time), "%Y-%m-%d %H:%i") AS data_alterada,temperature,air_humidity,ground_humidity')
                ->where('temperature', '<', 100)
                ->where('temperature', '>', -20);

        $query = DB::table('scans')->selectRaw('data_alterada, temperature, air_humidity, ground_humidity')
                 ->from(\DB::raw(' ( ' .$sub->toSql() . ' ) as sub '))
                 ->mergeBindings($sub)
                 ->whereBetween('data_alterada', array($initialDate,$finalDate))
                 ->get();

        return $query;
    }

    public static function getScansBySensor($initialDate, $finalDate, $sensor){
        $sub = DB::table('scans')->selectRaw('DATE_FORMAT(CONCAT(DATE," ",time), "%Y-%m-%d %H:%i") AS data_alterada,temperature,air_humidity,ground_humidity,id_sensor')
                ->where('id_sensor', '=', $sensor)
                ->where('temperature', '<', 100)
                ->where('temperature', '>', -20);

        $query = DB::table('scans')->selectRaw('data_alterada, temperature, air_humidity, ground_humidity,id_sensor')
                 ->from(\DB::raw(' ( ' .$sub->toSql() . ' ) as sub '))
                 ->mergeBindings($sub)
                 ->whereBetween('data_alterada', array($initialDate,$finalDate))
                 ->get();

        return $query;
    }

    public static function getScansByAmbient($initialDate, $finalDate, $ambient){
        $sub = DB::table('scans')->selectRaw('DATE_FORMAT(CONCAT(DATE," ",time), "%Y-%m-%d %H:%i") AS data_alterada,temperature,air_humidity,ground_humidity,id_ambient')
                ->where('id_ambient', '=', $ambient)
                ->where('temperature', '<', 100)
                ->where('temperature', '>', -20);

        $query = DB::table('scans')->selectRaw('data_alterada, temperature, air_humidity, ground_humidity,id_ambient')
                 ->from(\DB::raw(' ( ' .$sub->toSql() . ' ) as sub '))
                 ->mergeBindings($sub)
                 ->whereBetween('data_alterada', array($initialDate,$finalDate))
                 ->get();

        return $query;
    }

    public static function getScansBySensorAndAmbient($initialDate, $finalDate, $sensor, $ambient){
        $sub = DB::table('scans')->selectRaw('DATE_FORMAT(CONCAT(DATE," ",time), "%Y-%m-%d %H:%i") AS data_alterada,temperature,air_humidity,ground_humidity,id_sensor,id_ambient')
                ->where('id_sensor', '=', $sensor)
                ->where('id_ambient', '=', $ambient)
                ->where('temperature', '<', 100)
                ->where('temperature', '>', -20);

        $query = DB::table('scans')->selectRaw('data_alterada, temperature, air_humidity, ground_humidity,id_sensor,id_ambient')
                 ->from(\DB::raw(' ( ' .$sub->toSql() . ' ) as sub '))
                 ->mergeBindings($sub)
                 ->whereBetween('data_alterada', array($initialDate,$finalDate))
                 ->get();

        return $query;
    }

    public static function getTodayScans(){
        $query = DB::table('scans')->selectRaw('DATE_FORMAT(CONCAT(DATE," ",time), "%Y-%m-%d %H:%i") AS data_alterada, avg(temperature) temperature, 
                                                avg(air_humidity) air_humidity, avg(ground_humidity) ground_humidity')
                                   ->groupBy('data_alterada')
                                   ->where('date',Carbon::today())
                                   ->get();
        return $query;
    }

    public static function getTodayScanCount(){
        return DB::table('scans')->where('date',Carbon::today())->count();
    }

    public static function getTodayScanAvgs(){
        $avgs = array();

        $avgs['temperature'] = number_format(DB::table('scans')->where('date',Carbon::today())->avg('temperature'), 2, '.', '');
        $avgs['air_humidity'] = number_format(DB::table('scans')->where('date',Carbon::today())->avg('air_humidity'), 2, '.', '');
        $avgs['ground_humidity'] = number_format(DB::table('scans')->where('date',Carbon::today())->avg('ground_humidity'), 2, '.', '');
        return $avgs;
    }

}