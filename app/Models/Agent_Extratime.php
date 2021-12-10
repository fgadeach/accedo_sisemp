<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent_Extratime extends Model
{
    use HasFactory;

    protected $table = 'agent_extratime';
    public $timestamps = false;

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function schedule_week()
    {
        return $this->belongsTo(Schedule_Week::class, 'schedule_week_id');
    }
}
