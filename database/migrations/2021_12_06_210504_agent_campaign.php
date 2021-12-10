<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgentCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_campaigns', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('agentWeeksId');
            $table->unsignedBigInteger('campaignScheduleId');
            $table->foreign('agentWeeksId')->references('id')->on('agent_weeks');
            $table->foreign('campaignScheduleId')->references('id')->on('campaign_schedule');
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
