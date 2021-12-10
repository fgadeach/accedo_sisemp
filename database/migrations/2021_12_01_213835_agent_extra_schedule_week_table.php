<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentExtraScheduleWeekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_extratime', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('schedule_week_id');
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('schedule_week_id')->references('id')->on('schedule_weeks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_extratime');
    }
}
