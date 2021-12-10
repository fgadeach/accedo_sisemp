<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentWeekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_weeks', function (Blueprint $table) {
            $table->id();
            $table->boolean('available');

            $table->unsignedBigInteger('agent_id');
            $table->unsignedBigInteger('week_id');
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->foreign('week_id')->references('id')->on('weeks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_weeks');
    }
}
