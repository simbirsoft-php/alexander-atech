<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('stoa_id')->unique();
            $table->time('monday_from');
            $table->time('monday_to');
            $table->time('tuesday_from');
            $table->time('tuesday_to');
            $table->time('wednesday_from');
            $table->time('wednesday_to');
            $table->time('thursday_from');
            $table->time('thursday_to');
            $table->time('friday_from');
            $table->time('friday_to');
            $table->time('saturday_from');
            $table->time('saturday_to');
            $table->time('sunday_from');
            $table->time('sunday_to');
            $table->timestamps();

            $table->foreign('stoa_id')->references('id')->on('stoas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
