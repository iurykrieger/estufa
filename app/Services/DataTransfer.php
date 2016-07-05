<?php

namespace App\Services;

use App\Scan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DataTransfer
{   
    // chart/scans.blade.php
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

    public static function getMaxAndMinValue($ambient){

        $query = DB::table('ambients')->selectRaw('max_temperature, min_temperature,max_air_humidity, min_air_humidity,max_ground_humidity, min_ground_humidity')
                ->where('id_ambient','=',$ambient)
                ->get();

        return $query;
    }
    ////////////////////////////////////////////////////////////////////////////////////

    // views/index.blade.php
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

    public static function getLastInsertedSensors(){
        $query = DB::table('sensors')->join('ambients','sensors.id_ambient','=','ambients.id_ambient')
                                     ->select('sensors.*')
                                     ->get();

        return $query;
    }


    public static function getLastInsertedAmbients(){
        $query = DB::table('sensors')->join('ambients','sensors.id_ambient','=','ambients.id_ambient')
                                     ->select('ambients.*')
                                     ->get();

        return $query;
    }   

    public static function getAmbientAVG(){
        $query = DB::table('ambients')->selectRaw('description,
                                                   round(avg(max_temperature + min_temperature),2) as temperature,
                                                   round(avg(max_air_humidity + min_air_humidity),2) as air_humidity,
                                                   round(avg(max_ground_humidity + min_ground_humidity),2) as ground_humidity')
                                      ->groupBy('id_ambient')
                                      ->get();
        return $query;
    }

    ////////////////////////////////////////////////////////////////////////////////////

    // views/sensors/create.blade.php
    public static function transferGhostToScans($id_sensor){
    $id_ambient = DB::table('ghost_scans')->selectRaw('distinct sensors.id_ambient as id')->join('sensors','sensors.id_sensor','=','sensors.id_sensor')->where('sensors.id_sensor', '=', $id_sensor)->get();

        $ghosts = DB::table('ghost_scans')->get();
        
        foreach($ghosts as $ghost){
          DB::table('scans')->insert(['date'=>$ghost->date,'time'=>$ghost->time,'temperature'=>$ghost->temperature,'air_humidity'=>$ghost->air_humidity,'ground_humidity'=>$ghost->ground_humidity,'id_sensor'=>$ghost->id_sensor,'id_ambient'=>$id_ambient[0]->id]);
        }
        
        DB::table('ghost_scans')->where('id_sensor', '=', $ghost->id_sensor)->delete();
    }
    ////////////////////////////////////////////////////////////////////////////////////
}