<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserIdentity;
use Illuminate\Database\Seeder;

class UserIdentitySeeder extends Seeder
{
    public function run(): void
    {
        $identities = [
            [
                'user_id' => 2,
                'identity_type' => 'ktp',
                'identity_number' => '3275012308920001',
                'identity_image' => 'ktp_3275012308920001.jpg',
                'is_verified' => true,
                'verified_at' => '2026-01-16 10:30:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 3,
                'identity_type' => 'ktp',
                'identity_number' => '3471025605930002',
                'identity_image' => 'ktp_3471025605930002.jpg',
                'is_verified' => true,
                'verified_at' => '2026-01-20 14:15:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 4,
                'identity_type' => 'ktp',
                'identity_number' => '3578031501880003',
                'identity_image' => 'ktp_3578031501880003.jpg',
                'is_verified' => true,
                'verified_at' => '2026-02-05 09:45:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 5,
                'identity_type' => 'ktp',
                'identity_number' => '3374017505950004',
                'identity_image' => 'ktp_3374017505950004.jpg',
                'is_verified' => true,
                'verified_at' => '2026-02-10 11:20:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 6,
                'identity_type' => 'passport',
                'identity_number' => 'P12345678',
                'identity_image' => 'passport_p12345678.jpg',
                'is_verified' => true,
                'verified_at' => '2026-02-15 16:00:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 7,
                'identity_type' => 'ktp',
                'identity_number' => '1271092509910005',
                'identity_image' => 'ktp_1271092509910005.jpg',
                'is_verified' => true,
                'verified_at' => '2026-03-01 10:30:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 9,
                'identity_type' => 'ktp',
                'identity_number' => '1671016006940006',
                'identity_image' => 'ktp_1671016006940006.jpg',
                'is_verified' => true,
                'verified_at' => '2026-03-10 13:45:00',
                'verified_by' => 1,
            ],
            [
                'user_id' => 10,
                'identity_type' => 'ktp',
                'identity_number' => '3171010801890007',
                'identity_image' => 'ktp_3171010801890007.jpg',
                'is_verified' => true,
                'verified_at' => '2026-03-15 15:20:00',
                'verified_by' => 1,
            ],
        ];

        foreach ($identities as $identity) {
            UserIdentity::create($identity);
        }
    }
}