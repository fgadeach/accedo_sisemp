<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public function campaign_schedule(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Campaign_Schedule::class, 'campaign_id');
    }
}
