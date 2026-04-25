<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'user_id',
        'program_id',
        'amount',
        'fee_amount',
        'total_amount',
        'payment_method',
        'payment_status',
        'is_anonymous',
        'transaction_id',
        'proof_url',
        'certificate_url',
        'paid_at'
    ];

    protected function casts(): array
    {
        return [
            'is_anonymous' => 'boolean',
            'paid_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
