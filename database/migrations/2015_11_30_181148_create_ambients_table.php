<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmbientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ambients', function (Blueprint $table) {
            $table->increments('id_ambient')->unsigned();
            $table->timestamps();
            $table->text('description');
            $table->decimal('max_temperature',10,2);
            $table->decimal('min_temperature',10,2);
            $table->decimal('max_air_humidity',10,2);
            $table->decimal('min_air_humidity',10,2);
            $table->decimal('max_ground_humidity',10,2);
            $table->decimal('min_ground_humidity',10,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ambients');
    }
}
