<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    protected $primaryKey = 'program_id';

    protected $fillable = [
        'program_name',
        'description',
        'target_amount',
        'start_date',
        'end_date',
        'status',
        'image_url',
        'created_by',
        'category',
        'recipient_name',
        'beneficiary_type',
        'documents',
        'admin_feedback',
        'bank_name',
        'account_number',
        'account_owner',
        'rab_items',
        'updates'
    ];

    protected $casts = [
        'rab_items' => 'array',
        'documents' => 'array',
        'updates' => 'array',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class, 'program_id', 'program_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function campaign()
    {
        return $this->hasOne(ProgramCampaign::class, 'program_id', 'program_id');
    }

    public function distribution()
    {
        return $this->hasOne(\App\Models\Distribution::class, 'program_id', 'program_id');
    }
}
