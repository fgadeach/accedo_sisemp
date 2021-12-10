<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule_Week extends Model
{
    use HasFactory;

    protected $table = 'schedule_weeks';

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
    public function campaign_schedule(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(Campaign_Schedule::class, 'schedule_week_id');
    }
    public function agent_extratime(): \Illuminate\Database\Eloquent\Relations\HasOne {
        return $this->hasOne(Agent_Extratime::class, 'schedule_week_id');
    }
   
}
