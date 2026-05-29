<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\PaymentLog;

class PopulateLogsService
{
    /**
     * Retroactively populates the payment_logs table for donations that don't have one yet.
     */
    public function run()
    {
        $donations = Donation::all();
        $count = 0;

        foreach ($donations as $don) {
            if (!PaymentLog::where('donation_id', $don->id)->exists()) {
                PaymentLog::create([
                    'donation_id' => $don->id,
                    'transaction_id' => 'TRX-' . strtoupper(uniqid()),
                    'payment_type' => $don->payment_method ?? 'Unknown',
                    'raw_response' => json_encode(['status' => 'retroactive', 'message' => 'Retroactively added'])
                ]);
                $count++;
            }
        }

        return $count;
    }
}
