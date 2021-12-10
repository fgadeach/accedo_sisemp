<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function agent_week(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Agent_Week::class, 'agent_id');
    }

    public function agent_extratime(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Agent_Extratime::class, 'agent_id');
    }
}
