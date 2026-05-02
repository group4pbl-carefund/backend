<?php

namespace App\Services;

use App\Models\Donation;

class DonationService
{
    public function getAll()
    {
        return Donation::with(['program', 'user'])->latest()->get();
    }

    public function store(array $data)
    {

        $data['total_amount'] = $data['amount'] + ($data['fee_amount'] ?? 0);
        $data['payment_status'] = $data['payment_status'] ?? 'pending';
        
        return Donation::create($data);
    }
}