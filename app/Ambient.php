<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambient extends Model
{
	/**
	 * Name of the table
	 * @var string
	 */
    protected $table = 'ambients';

    /**
     * Name of the id primary key column
     * @var string
     */
    protected $primaryKey = 'id_ambient';

    /**
     * Boolean of timestamps columns created_at and updated_at
     * @var boolean
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = ['description', 'max_temperature', 'min_temperature', 'max_air_humidity', 'min_air_humidity', 'max_ground_humidity', 'min_ground_humidity'];

    /**
     * Scans of Ambient
     * @return Collection of App\Scan
     */
    public function scans(){
        return $this->hasMany('App\Scan','id_ambient');
    }

    /**
     * Sensors of Ambient
     * @return Collection of App\Sensor
     */
    public function sensors(){
        return $this->hasMany('App\Sensor','id_ambient');
    }
}
