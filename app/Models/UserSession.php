<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSession extends Model
{
    protected $primaryKey = 'session_id';

    protected $fillable = [
        'user_id',
        'token',
        'user_agent',
        'login_at',
        'expires_at',
        'ip_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
