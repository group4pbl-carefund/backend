<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\PaymentLog;
use Illuminate\Database\Seeder;

class PaymentLogSeeder extends Seeder
{
    public function run(): void
    {
        $donations = Donation::where('status', 'success')->get();

        $paymentLogs = [
            [
                'transaction_id' => 'TXN202601050001',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank Central Asia (BCA)',
                    'va_number' => '1234567890',
                    'amount' => 500000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-05 10:30:15',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601060002',
                'payment_type' => 'e_wallet',
                'raw_response' => json_encode([
                    'provider' => 'GoPay',
                    'merchant_id' => 'MERCH12345',
                    'amount' => 1000000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-06 14:20:30',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601070003',
                'payment_type' => 'credit_card',
                'raw_response' => json_encode([
                    'card_brand' => 'Visa',
                    'card_number' => '411111****1111',
                    'amount' => 250000,
                    'authorization_code' => 'AUTH123456',
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-07 09:15:45',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601080004',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank Mandiri',
                    'va_number' => '9876543210',
                    'amount' => 750000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-08 16:45:20',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601100005',
                'payment_type' => 'e_wallet',
                'raw_response' => json_encode([
                    'provider' => 'OVO',
                    'merchant_id' => 'MERCH54321',
                    'amount' => 1500000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-10 11:00:10',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601120006',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'BNI',
                    'va_number' => '5555666677',
                    'amount' => 300000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-12 08:30:25',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601150007',
                'payment_type' => 'e_wallet',
                'raw_response' => json_encode([
                    'provider' => 'Dana',
                    'merchant_id' => 'MERCH11111',
                    'amount' => 800000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-15 12:00:00',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601180008',
                'payment_type' => 'e_wallet',
                'raw_response' => json_encode([
                    'provider' => 'ShopeePay',
                    'merchant_id' => 'MERCH22222',
                    'amount' => 100000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-18 17:30:15',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601200009',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'BTN',
                    'va_number' => '7777888899',
                    'amount' => 2000000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-20 09:00:30',
                ]),
            ],
            [
                'transaction_id' => 'TXN202601250010',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank Central Asia (BCA)',
                    'va_number' => '1111222233',
                    'amount' => 5000000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-01-25 14:00:45',
                ]),
            ],
            [
                'transaction_id' => 'TXN202602010011',
                'payment_type' => 'e_wallet',
                'raw_response' => json_encode([
                    'provider' => 'GoPay',
                    'merchant_id' => 'MERCH33333',
                    'amount' => 350000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-02-01 10:30:20',
                ]),
            ],
            [
                'transaction_id' => 'TXN202602050012',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank Permata',
                    'va_number' => '4444555566',
                    'amount' => 1200000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-02-05 13:15:10',
                ]),
            ],
            [
                'transaction_id' => 'TXN202602100013',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank Central Asia (BCA)',
                    'va_number' => '5555666777',
                    'amount' => 10000000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-02-10 08:00:00',
                ]),
            ],
            [
                'transaction_id' => 'TXN202602150014',
                'payment_type' => 'credit_card',
                'raw_response' => json_encode([
                    'card_brand' => 'MasterCard',
                    'card_number' => '551122****3344',
                    'amount' => 450000,
                    'authorization_code' => 'AUTH789012',
                    'status' => 'settlement',
                    'transaction_time' => '2026-02-15 15:30:25',
                ]),
            ],
            [
                'transaction_id' => 'TXN202602200015',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank Muamalat',
                    'va_number' => '6666777888',
                    'amount' => 2500000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-02-20 11:00:40',
                ]),
            ],
            [
                'transaction_id' => 'TXN202603010016',
                'payment_type' => 'bank_transfer',
                'raw_response' => json_encode([
                    'bank' => 'Bank BRI',
                    'va_number' => '7777889900',
                    'amount' => 3000000,
                    'status' => 'settlement',
                    'transaction_time' => '2026-03-01 10:00:15',
                ]),
            ],
        ];

        $index = 0;
        foreach ($donations as $donation) {
            if ($index < count($paymentLogs)) {
                PaymentLog::create([
                    'donation_id' => $donation->id,
                    'transaction_id' => $paymentLogs[$index]['transaction_id'],
                    'payment_type' => $paymentLogs[$index]['payment_type'],
                    'raw_response' => $paymentLogs[$index]['raw_response'],
                ]);
                $index++;
            }
        }
    }
}