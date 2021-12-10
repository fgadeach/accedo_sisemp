<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScheduleWeekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_weeks', function (Blueprint $table) {
            $table->id();            
            $table->timestamps();

            $table->unsignedBigInteger('week_id');
            $table->unsignedBigInteger('schedule_id');
            $table->foreign('week_id')->references('id')->on('weeks');
            $table->foreign('schedule_id')->references('id')->on('schedules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_weeks');
    }
}
