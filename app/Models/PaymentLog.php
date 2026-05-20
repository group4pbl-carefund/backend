<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $fillable = [
        'donation_id',
        'transaction_id',
        'payment_type',
        'raw_response'
    ];

    protected $casts = [
        'raw_response' => 'array',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}
