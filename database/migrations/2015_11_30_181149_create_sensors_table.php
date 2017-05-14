<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id_sensor')->unsigned();
            $table->integer('real_id')->unsigned();
            $table->timestamps();
            $table->integer('id_ambient')->unsigned();
            $table->text('description');
            $table->boolean('active');
        });

        Schema::table('sensors', function($table) {
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
        Schema::drop('sensors');
    }
}
