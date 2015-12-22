<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scan extends Model
{
    /**
	 * Name of the table
	 * @var string
	 */
    protected $table = 'scans';

    /**
     * Name of the id primary key column
     * @var string
     */
    protected $primaryKey = 'id_scan';

    /**
     * Boolean of timestamps columns created_at and updated_at
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Sensor of Scan
     * @return App\Sensor
     */
    public function sensor(){
        return $this->belongsTo('App\Sensor','id_sensor');
    }

    /**
     * Ambient of Sensor
     * @return App\Ambient
     */
    public function ambient(){
        return $this->belongsTo('App\Ambient','id_ambient');
    }
}
