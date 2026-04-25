<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCampaign extends Model
{
    protected $primaryKey = 'campaign_id';
    const UPDATED_AT = 'last_update_date';

    protected $fillable = [
        'program_id',
        'current_amount',
        'available_balance',
        'donor_count',
        'last_update_date'
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
