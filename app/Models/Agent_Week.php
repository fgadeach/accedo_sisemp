<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent_Week extends Model
{
    use HasFactory;

    protected $table = 'agent_weeks';

    public $timestamps = false;

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id');
    }
}
