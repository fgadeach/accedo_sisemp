<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    public function agent_week()
    {
        return $this->hasOne(Agent_Week::class, 'week_id');
    }
    public function schedule_week()
    {
        return $this->hasMany(Schedule_Week::class, 'week_id');
    }
}
