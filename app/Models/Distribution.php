<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    protected $primaryKey = 'distribution_id';

    protected $fillable = [
        'program_id',
        'recipient_name',
        'recipient_location',
        'amount',
        'status',
        'evidence_url',
        'notes',
        'created_by'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
