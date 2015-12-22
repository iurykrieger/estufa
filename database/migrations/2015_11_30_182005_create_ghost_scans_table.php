<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGhostScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ghost_scans', function (Blueprint $table) {
            $table->increments('id_ghost_scan')->unsigned();
            $table->timestamps();
            $table->date('date');
            $table->time('time');
            $table->decimal('temperature',10,2);
            $table->decimal('air_humidity',10,2);
            $table->decimal('ground_humidity',10,2);
            $table->integer('id_sensor')->unsigned();
        });

        Schema::table('ghost_scans', function($table) {
            $table->foreign('id_sensor')->references('id_sensor')->on('sensors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ghost_scans');
    }
}
