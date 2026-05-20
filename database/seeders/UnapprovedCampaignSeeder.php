<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use App\Models\ProgramCampaign;
use App\Models\User;

class UnapprovedCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'full_name' => 'Campaign Creator',
                'email' => 'creator@carefund.com',
                'password' => bcrypt('password'),
                'is_verified' => true,
                'role' => 'user'
            ]);
        }

        $programs = [
            [
                'program_name' => 'Bantuan Medis Anak Kurang Mampu (Belum Disetujui)',
                'description' => 'Membantu biaya operasi dan pengobatan anak-anak kurang mampu di daerah terpelosok yang membutuhkan penanganan medis segera.',
                'target_amount' => 50000000,
                'start_date' => now()->addDays(2),
                'end_date' => now()->addDays(32),
                'status' => 'pending',
                'image_url' => 'https://images.unsplash.com/photo-1584515933487-779824d29309?w=600&q=80',
                'created_by' => $user->id,
            ],
            [
                'program_name' => 'Renovasi Sekolah Rusak di Pelosok Desa',
                'description' => 'Banyak anak-anak di desa yang belajar di bawah atap bocor dan bangunan yang hampir rubuh. Mari kita bangun kembali sekolah mereka.',
                'target_amount' => 150000000,
                'start_date' => now()->addDays(5),
                'end_date' => now()->addDays(65),
                'status' => 'pending',
                'image_url' => 'https://images.unsplash.com/photo-1497633762265-9d179a990aa6?w=600&q=80',
                'created_by' => $user->id,
            ],
            [
                'program_name' => 'Program Air Bersih untuk Dusun Kekeringan',
                'description' => 'Pembuatan sumur bor dan fasilitas air bersih untuk dusun yang kesulitan mendapat air di musim kemarau panjang tahun ini.',
                'target_amount' => 35000000,
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(30),
                'status' => 'pending',
                'image_url' => 'https://images.unsplash.com/photo-1541888062879-11ba186088d5?w=600&q=80',
                'created_by' => $user->id,
            ]
        ];

        foreach ($programs as $progData) {
            $program = Program::create($progData);
            
            ProgramCampaign::create([
                'program_id' => $program->program_id,
                'current_amount' => 0,
                'available_balance' => 0,
                'donor_count' => 0,
                'last_update_date' => now()
            ]);
        }
    }
}
