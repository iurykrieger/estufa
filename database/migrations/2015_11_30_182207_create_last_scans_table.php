<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('last_scans', function (Blueprint $table) {
            $table->increments('id_last_scan')->unsigned();
            $table->timestamps();
            $table->date('date');
            $table->time('time');
            $table->decimal('temperature',10,2);
            $table->decimal('air_humidity',10,2);
            $table->decimal('ground_humidity',10,2);
            $table->integer('id_sensor')->unsigned();
        });

        Schema::table('last_scans', function($table) {
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
        Schema::drop('last_scans');
    }
}
