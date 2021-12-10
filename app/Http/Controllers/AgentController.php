<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Agent;
use App\Models\Agent_Week;
use App\Models\Agent_Extratime;
use App\Models\Campaign;
use App\Models\Campaign_Schedule;
use App\Models\Week;
use App\Models\Schedule_Week;
use App\Models\Schedule;

class AgentController extends Controller
{
    public function getAgents()
    {
        $agents = Agent::get();
        $ag = Agent::Where('id','=',auth()->user()->agent->id)->get();

        $scheduls = Schedule::Where('schedule_hour','<',$ag->end_date)->get();

        return view('admin.admindash', compact('agents','scheduls'));
    }

    public function getAgentSchedule($id)
    {
        $agentWeeks = Agent_Week::where('agent_id', '=', 'id')->get();
        $week = Week::where('id', '=', 'agentWeeks.id')->get();
        return view('agente.agentedash', compact('agentWeeks', 'week'));
    }

    public function storeAgentWeek(Week $week)
    {
        $scheduls = Schedule::Where('hour','<=',auth()->user()->agent->endTime)->where('hour','>=',auth()->user()->agent->startTime)->get();
        if ($agent_week = Agent_Week::where('week_id', $week->id)->first()) {

            foreach($scheduls as $sch){
                $scheduleWeek = Schedule_Week::where('week_id',$week->id)->where('schedule_id',$sch->id)->first();
                $campaign_schedule = Campaign_Schedule::where('campaign_id',auth()->user()->agent->campaign_id)->where('schedule_week_id', $scheduleWeek->id)->first();
                $campaign_schedule->manpower = $campaign_schedule->manpower + 1;
                $campaign_schedule->update();
            }
            $agent_week->delete();
        }else{
            if(count(Agent_Week::where('agent_id', auth()->user()->agent->id)->get())<2){
                $agent_week = new Agent_Week();
                $agent_week->available = true;
                $agent_week->agent_id = auth()->user()->agent->id;
                $agent_week->week_id = $week->id;
                foreach($scheduls as $sch){
                    $scheduleWeek = Schedule_Week::where('week_id',$week->id)->where('schedule_id',$sch->id)->first();
                    $campaign_schedule = Campaign_Schedule::where('campaign_id',auth()->user()->agent->campaign_id)->where('schedule_week_id', $scheduleWeek->id)->first();
                    $campaign_schedule->manpower = $campaign_schedule->manpower - 1;
                    $campaign_schedule->update();
                }
                $agent_week->save();
            }
        }
        return back();
    }

    public function viewAgentExtratime(Agent $agent)
    {
        

        $scheduls = Schedule::Where('hour','>',auth()->user()->agent->endTime)->orWhere('hour','<',auth()->user()->agent->startTime)->get();
        
        $weeks = Week::get();
        return view('agente.overtime', compact('scheduls','weeks'));
    }

    public function storeAgentExtratime(Week $week, Schedule $schedule){

        $scheduleWeek = Schedule_Week::where('week_id',$week->id)->where('schedule_id',$schedule->id)->first();

        if ($agent_extratime = Agent_Extratime::where('agent_id',auth()->user()->agent->id)->where('schedule_week_id',$scheduleWeek->id)->first()) {
            $campaign_schedule = Campaign_Schedule::where('campaign_id',auth()->user()->agent->campaign_id)->where('schedule_week_id', $scheduleWeek->id)->first();
            $campaign_schedule->manpower = $campaign_schedule->manpower - 1;
            $campaign_schedule->update();
            $agent_extratime->delete();
        }
        else{
            $agent_extratime = new Agent_Extratime();
            $agent_extratime->agent_id = auth()->user()->agent->id;
            $agent_extratime->schedule_week_id = $scheduleWeek->id;
            $campaign_schedule = Campaign_Schedule::where('campaign_id',auth()->user()->agent->campaign_id)->where('schedule_week_id', $scheduleWeek->id)->first();
            $campaign_schedule->manpower = $campaign_schedule->manpower +1;
            
            $campaign_schedule->update();
            $agent_extratime->save();
        }

        return back();

    }
}
