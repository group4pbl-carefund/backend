<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $primaryKey = 'log_id';

    protected $fillable = [
        'donation_id',
        'payment_method',
        'payment_response',
        'status'
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}
