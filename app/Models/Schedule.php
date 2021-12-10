<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    public function schedule_week()
    {
        return $this->hasMany(Schedule_Week::class, 'schedule_id');
    }
    public function campaign_schedule()
    {
        return $this->hasMany(Campaign_Schedule::class, 'schedule_id');
    }
}
