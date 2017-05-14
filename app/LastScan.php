<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastScan extends Model
{
    /**
	 * Name of the table
	 * @var string
	 */
    protected $table = 'last_scans';

    /**
     * Name of the id primary key column
     * @var string
     */
    protected $primaryKey = 'id_last_scan';

    /**
     * Boolean of timestamps columns created_at and updated_at
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Sensor of LastScan
     * @return App\Sensor
     */
    public function sensor(){
        return $this->belongsTo('App\Sensor','id_sensor');
    }
}
