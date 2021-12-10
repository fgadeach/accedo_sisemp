<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Campaign_Schedule;
use App\Models\Schedule_Week;
use App\Models\Week;
use App\Models\Schedule;
use App\Models\Agent;


class AdminController extends Controller
{
    public function getCampaigns()
    {
        $campaigns = Campaign::get();
        return view('admin.admindash', compact('campaings'));
    }

    public function getCampaignSchedule($id)
    {
        $campaignSchedule = Campaign_Schedule::where('campaign_id', '=', 'id')->get();
        return view('admin.admindash', compact('campaignSchedule'));
    }

    public function getScheduleWeeks($id)
    {
        $scheduleWeeks = Schedule_Week::where('schedule_id', '=', 'id')->get();
        return view('admin.admindash', compact('scheduleWeeks'));
    }

    public function index($camp=null){
        $campaigns = Campaign::get();

        if($camp==null){
            $campaign = Campaign::first();
        }
        else{
            $campaign = Campaign::find($camp);
        }

        $schedules = Schedule::whereHas('schedule_week.campaign_schedule',function($param) use($campaign){
            $param->where('campaign_id',$campaign->id); 

        })->get();

        $weeks = Week::whereHas('schedule_week.campaign_schedule',function($param) use($campaign){
            $param->where('campaign_id',$campaign->id); 
           
        })->with('schedule_week.campaign_schedule',function($param) use($campaign){
            $param->where('campaign_id',$campaign->id); 
        })->get();


        $campaignSchedule = Campaign_Schedule::with('schedule_week.week','schedule_week.schedule')->where('campaign_id', '=', $campaign->id)->get();

        return view('admin.admindash', compact('campaignSchedule','campaign','campaigns','schedules','weeks'));
    }

    public function createCampaign(){
        return view('admin.campaignForm');
    }

    public function storeCampaign(Request $request){
        $campaign = new Campaign();
        $campaign->name = $request->campaignName;
            if($request->endTime != null){
                $campaign->save();
                $scheduls = Schedule::Where('hour','<=',$request->endTime)->where('hour','>=',$request->startTime)->get();
                foreach($scheduls as $sc){
                    $schedule_weeks = Schedule_Week::Where('schedule_id',$sc->id)->get();
                    foreach($schedule_weeks as $sw){
                        $campaignSchedule = new Campaign_Schedule();
                        $campaignSchedule->headcount = $request->manpower;
                        $campaignSchedule->campaign_id = $campaign->id;
                        $campaignSchedule->schedule_week_id = $sw->id;
                        $campaignSchedule->manpower = 0;
                        $campaignSchedule->save();
                    }
                }
                return view('/dashboard');
            }
            return "Campos incorrectos";
    }

    public function updateHeadcount(Campaign $campaign){
        $agents = Agent::where('campaign_id', $campaign->id)->get();
        
        Campaign_Schedule::where('campaign_id', $campaign->id)->update(['manpower'=>0]);

        foreach($agents as $agent){
            $scheduls = Schedule::Where('hour','<=',$agent->endTime)->where('hour','>=',$agent->startTime)->get();
            $weeks = Week::get();
            foreach ($weeks as $w){
                foreach($scheduls as $sw){
                    $schedule_weeks = Schedule_Week::where('schedule_id', $sw->id)->where('week_id',$w->id)->first();
                    $campaignSchedule = Campaign_Schedule::where('schedule_week_id',$schedule_weeks->id)->where('campaign_id',$campaign->id)->first();
                    $campaignSchedule->manpower = $campaignSchedule->manpower+1;
                    $campaignSchedule->update();
                }
            }
        }
        return back();
    }
}
