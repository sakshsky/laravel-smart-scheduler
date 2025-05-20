<?php

namespace Sakshsky\SmartScheduler\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledTask extends Model
{
    protected $fillable = [
        'name',
        'cron_expression',
        'command',
        'timezone',
        'enabled',
        'last_run_at',
        'next_run_at',
        'status',
        'output'
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime'
    ];
}