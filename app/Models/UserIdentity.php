<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserIdentity extends Model
{
    protected $fillable = [
        'user_id',
        'identity_type',
        'identity_number',
        'identity_image',
        'is_verified',
        'verified_at',
        'verified_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
}
