<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTermsAgreement extends Model
{
    protected $primaryKey = 'agreement_id';

    protected $fillable = [
        'user_id',
        'version_id',
        'agreed_at',
        'ip_address',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
