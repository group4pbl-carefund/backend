<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityMonitoring extends Model
{
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'event_type',
        'severity',
        'user_id',
        'ip_address',
        'user_agent',
        'action',
        'description',
        'details'
    ];
}
