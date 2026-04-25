<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TermVersion extends Model
{
    protected $primaryKey = 'version_id';

    protected $fillable = [
        'version_number',
        'content',
        'effective_date',
    ];

    public function userTermsAgreements()
    {
        return $this->hasMany(UserTermsAgreement::class, 'version_id');
    }
}
