<?php

namespace App\Services;

use App\Models\PaymentLog;

class PaymentLogService
{
    public function getAll()
    {
        return PaymentLog::with('donation.user', 'donation.program')->latest()->get();
    }

    public function store(array $data)
    {
        return PaymentLog::create($data);
    }
}