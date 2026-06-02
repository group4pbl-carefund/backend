<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributionUpdate extends Model
{
    protected $fillable = [
        'distribution_id',
        'status',
        'notes',
        'proof_url',
        'updated_by'
    ];

    public function distribution()
    {
        return $this->belongsTo(Distribution::class, 'distribution_id', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
