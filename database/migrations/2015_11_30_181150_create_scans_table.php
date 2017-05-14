<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scans', function (Blueprint $table) {
            $table->increments('id_scan')->unsigned();
            $table->timestamps();
            $table->date('date');
            $table->time('time');
            $table->decimal('temperature',10,2);
            $table->decimal('air_humidity',10,2);
            $table->decimal('ground_humidity',10,2);
            $table->integer('id_sensor')->unsigned();
            $table->integer('id_ambient')->unsigned();
        });

        Schema::table('scans', function($table) {
            $table->foreign('id_sensor')->references('id_sensor')->on('sensors');
            $table->foreign('id_ambient')->references('id_ambient')->on('ambients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('scans');
    }
}
