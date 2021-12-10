<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Agent_Extratime;
use App\Models\Agent;
use App\Models\Week;
use App\Models\Campaign;
use App\Models\Agent_Week;
use App\Models\Campaign_Schedule;
use App\Models\Schedule;
use App\Models\Schedule_Week;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(["guest"]);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $weeks = Week::with('agent_week.agent')->get();
    $agentWeeks = Agent_Week::get();
    $agentExtra= Agent_Extratime::get();
    $campaigns = Campaign::get();
    $campaignSchedule = Campaign_Schedule::get();
    $schedules = Schedule::get();
    $scheduleWeeks = Schedule_Week::get();

    return view('dashboard', compact('weeks', 'agentWeeks','campaigns','schedules','agentExtra'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/getAgentSchedule', [AgentController::class, "getAgentSchedule"])->name('getAgentSchedule');

Route::get('/AgentWeek/{week}', [\App\Http\Controllers\AgentController::class, 'storeAgentWeek']);

Route::get('/ScheduleWeeks/{schedule}', [\App\Http\Controllers\AdminController::class, 'getScheduleWeeks']);

Route::get('admin', function () {
    return "Registrado";
});

Route::get('agente', function () {
    $agent = User::find(2);
    $agent->assignRole("agent");
    return "Registrado";
});

Route::get('test', function () {

 for($i=1;$i<4;$i++){
        $faker = \Faker\Factory::create();
        $user = new User();
        $user->name = $faker->name();
        $user->email = $faker->unique()->safeEmail();
        $user->password = bcrypt('12345678');
        $user->save();

        $agent = new Agent();
        $agent->user_id = $user->id;
        $agent->campaign_id = 1;
        $agent->startTime =  date('H:0:0', rand(57600,64800));
        $agent->endTime =  date('H:0:0', rand(68400,90000));
        $agent->manpower = 0;
        $agent->save();

        $agent = User::find($user->id);
        $agent->assignRole("agent");
    }
});

Route::get('/CampaignSchedule/{campaign?}', [\App\Http\Controllers\AdminController::class, 'index']);

Route::get('/AgentOvertime/{agent?}', [\App\Http\Controllers\AgentController::class, 'viewAgentExtratime']);


Route::get('/extraschedule/{week}/{schedule}', [\App\Http\Controllers\AgentController::class, 'storeAgentExtratime']);


Route::get('/CreateCampaign', [\App\Http\Controllers\AdminController::class, 'createCampaign']);

Route::post('/CreateCampaign/store', [\App\Http\Controllers\AdminController::class, 'storeCampaign'])->name('createCampaign.store');

Route::get('/UpdateHeadcount/{campaign}', [\App\Http\Controllers\AdminController::class, 'updateHeadcount']);