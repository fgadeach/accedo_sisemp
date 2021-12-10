<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign_Schedule extends Model
{
    use HasFactory;

    protected $table = 'campaign_schedule';
    public $timestamps = false;

    public function agent_extratime(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Agent_Extratime::class, 'campaign_schedule_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function schedule_week()
    {
        return $this->belongsTo(Schedule_Week::class, 'schedule_week_id');
    }
}
