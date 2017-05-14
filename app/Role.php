<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
	 * Name of the table
	 * @var string
	 */
    protected $table = 'roles';

    /**
     * Name of the id primary key column
     * @var string
     */
    protected $primaryKey = 'id_role';

    /**
     * Boolean of timestamps columns created_at and updated_at
     * @var boolean
     */
    public $timestamps = true;

    /**
     * Users of Role
     * @return Collection of App\User
     */
    public function users(){
        return $this->hasMany('App\User','id_role');
    }
}
