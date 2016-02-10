<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    /**
	 * Name of the table
	 * @var string
	 */
    protected $table = 'sensors';

    /**
     * Name of the id primary key column
     * @var string
     */
    protected $primaryKey = 'id_sensor';

    /**
     * Boolean of timestamps columns created_at and updated_at
     * @var boolean
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description','id_ambient','active'];

    /**
     * GhostScans of Sensor
     * @return Collection of App\GhostScan
     */
    public function ghostScans(){
        return $this->hasMany('App\GhostScan','id_sensor');
    }

    /**
     * LastScans of Sensor
     * @return Collection of App\LastScan
     */
    public function lastScans(){
        return $this->hasMany('App\LastScan','id_sensor');
    }

    /**
     * Scans of Sensor
     * @return Collection of App\Scan
     */
    public function scans(){
        return $this->hasMany('App\Scan','id_sensor');
    }

    /**
     * Ambient of Sensor
     * @return App\Ambient
     */
    public function ambient(){
        return $this->belongsTo('App\Ambient','id_ambient');
    }
}
