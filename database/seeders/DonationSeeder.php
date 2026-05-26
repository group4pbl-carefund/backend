<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $donations = [
            [
                'user_id' => 1,
                'program_id' => 1,
                'amount' => 500000,
                'payment_method' => 'transfer_bank',
                'notes' => 'Semangat untuk anak-anak yang membutuhkan!',
                'payment_status' => 'completed',
                'is_anonymous' => false,
                'paid_at' => '2026-01-05 10:30:00',
                'created_at' => '2026-01-05 10:30:00',
            ],
            [
                'user_id' => 2,
                'program_id' => 1,
                'amount' => 1000000,
                'payment_method' => 'e_wallet',
                'notes' => 'Semoga membantu saudara kita yang membutuhkan',
                'payment_status' => 'completed',
                'is_anonymous' => false,
                'paid_at' => '2026-01-06 14:20:00',
                'created_at' => '2026-01-06 14:20:00',
            ],
            [
                'user_id' => null,
                'program_id' => 1,
                'amount' => 250000,
                'payment_method' => 'credit_card',
                'notes' => 'Terima kasih Carefund atas platformnya',
                'payment_status' => 'completed',
                'is_anonymous' => true,
                'paid_at' => '2026-01-07 09:15:00',
                'created_at' => '2026-01-07 09:15:00',
            ]
        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}