<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\PaymentLog;

class StandardizeTransactionService
{
    /**
     * Standardizes all transaction IDs across donations and payment logs to use the INV-CF-YYYYMMDD-ID format.
     */
    public function run()
    {
        $donations = Donation::all();
        $count = 0;

        foreach ($donations as $don) {
            $trxId = 'INV-CF-' . date('Ymd', strtotime($don->created_at)) . str_pad($don->id, 4, '0', STR_PAD_LEFT);
            
            // Update donation table
            $don->update(['transaction_id' => $trxId]);
            
            // Update payment_log table
            $log = PaymentLog::where('donation_id', $don->id)->first();
            if ($log) {
                $log->update(['transaction_id' => $trxId]);
            }
            $count++;
        }

        return $count;
    }
}
