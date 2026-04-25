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
        'created_by'
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
