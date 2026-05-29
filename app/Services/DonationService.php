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
        // Gunakan intval untuk menghindari floating point imprecision
        // Contoh: 20000000.0 bisa menjadi 19999996 jika dihitung dengan float
        $amount    = intval(round($data['amount']));
        $feeAmount = intval(round($data['fee_amount'] ?? 0));

        $data['amount']        = $amount;
        $data['fee_amount']    = $feeAmount;
        $data['total_amount']  = $amount + $feeAmount;
        $data['payment_status'] = $data['payment_status'] ?? 'pending';
        
        $donation = Donation::create($data);
        
        $transactionId = 'INV-CF-' . date('Ymd', strtotime($donation->created_at)) . str_pad($donation->id, 4, '0', STR_PAD_LEFT);
        
        $donation->update(['transaction_id' => $transactionId]);
        
        // Catat ke log transaksi (payment log)
        \App\Models\PaymentLog::create([
            'donation_id' => $donation->id,
            'transaction_id' => $transactionId,
            'payment_type' => $donation->payment_method ?? 'Unknown',
            'raw_response' => json_encode(['status' => 'initiated', 'message' => 'Donation created by user'])
        ]);
        
        return $donation;
    }
}