<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'paid_at',
        'notes'
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id', 'program_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
        ];
    }
}