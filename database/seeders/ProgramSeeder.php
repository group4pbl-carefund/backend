<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramCampaign;
use App\Models\ProgramCategoryMapping;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            [
                'program_name' => 'Bantu Operasi Jantung Anak Indonesia',
                'description' => 'Bantuan operasi jantung untuk anak-anak dari keluarga kurang mampu yang memerlukan penanganan medis segera. Setiap hari, banyak anak di Indonesia yang lahir dengan kelainan jantung dan membutuhkan operasi yang mahal.',
                'target_amount' => 250000000,
                'start_date' => '2026-01-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?w=800',
                'created_by' => 2,
                'categories' => [1, 5],
                'current_amount' => 187500000,
                'donor_count' => 1247,
            ],
            [
                'program_name' => 'Beasiswa Anak Bangsa 2026',
                'description' => 'Program scholarships untuk anak-anak berprestasi dari keluarga kurang mampu agar dapat melanjutkan pendidikan ke jenjang yang lebih tinggi.',
                'target_amount' => 150000000,
                'start_date' => '2026-02-01',
                'end_date' => '2026-11-30',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=800',
                'created_by' => 3,
                'categories' => [2, 5],
                'current_amount' => 89500000,
                'donor_count' => 856,
            ],
            [
                'program_name' => 'Bantuan Gempa bumi Cianjur',
                'description' => 'Bantuan darurat untuk korban gempa bumi di Cianjur, Jawa Barat. Dana akan digunakan untuk kebutuhan shelters, makanan, dan pemulihan.',
                'target_amount' => 500000000,
                'start_date' => '2026-01-15',
                'end_date' => '2026-06-30',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1516912481808-3406841bd33c?w=800',
                'created_by' => 2,
                'categories' => [3, 5],
                'current_amount' => 425000000,
                'donor_count' => 3892,
            ],
            [
                'program_name' => 'Zakat Fitrah 1447H',
                'description' => 'Program pengumpulan zakat fitrah untuk didistribusikan kepada mustahik di berbagai daerah.',
                'target_amount' => 1000000000,
                'start_date' => '2026-03-01',
                'end_date' => '2026-04-30',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1577953138796-f5ae8c0e9c80?w=800',
                'created_by' => 1,
                'categories' => [4],
                'current_amount' => 678000000,
                'donor_count' => 5678,
            ],
            [
                'program_name' => 'Renovasi Panti Asuhan Nurul Hasanah',
                'description' => 'Renovasi buildings dan fasilitas di Panti Asuhan Nurul Hasanah yang membutuhkan perbaikan mendesak.',
                'target_amount' => 75000000,
                'start_date' => '2026-02-15',
                'end_date' => '2026-08-15',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1594708767771-a7502209ff51?w=800',
                'created_by' => 4,
                'categories' => [5],
                'current_amount' => 45000000,
                'donor_count' => 312,
            ],
            [
                'program_name' => 'Tanam 10.000 Pohon 2026',
                'description' => 'Program reboisasi dan penghijauan untuk menjaga kelestarian lingkungan dan mencegah banjir.',
                'target_amount' => 125000000,
                'start_date' => '2026-03-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=800',
                'created_by' => 5,
                'categories' => [6],
                'current_amount' => 58000000,
                'donor_count' => 445,
            ],
            [
                'program_name' => 'Modal Usaha Mikro Pedagang Kecil',
                'description' => 'Bantuan modal usaha untuk pedagang kecil dan pelaku UMKM yang membutuhkan dukungan modal.',
                'target_amount' => 200000000,
                'start_date' => '2026-01-10',
                'end_date' => '2026-10-10',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=800',
                'created_by' => 6,
                'categories' => [7],
                'current_amount' => 156000000,
                'donor_count' => 789,
            ],
            [
                'program_name' => 'Bangun Masjid Al-Hidayah',
                'description' => 'Pembangunan Masjid Al-Hidayah di desa terpencil yang belum memiliki tempat ibadah yang layak.',
                'target_amount' => 350000000,
                'start_date' => '2026-02-01',
                'end_date' => '2027-02-01',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1564769624456-ddd3fbad8b03?w=800',
                'created_by' => 3,
                'categories' => [8],
                'current_amount' => 178000000,
                'donor_count' => 1234,
            ],
            [
                'program_name' => 'Obat-obatan untuk RS Indonesia Timur',
                'description' => 'Bantuan pembelian obat-obatan dan peralatan medis untuk rumah sakit di daerah Indonesia Timur.',
                'target_amount' => 180000000,
                'start_date' => '2026-03-15',
                'end_date' => '2026-09-15',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=800',
                'created_by' => 1,
                'categories' => [1, 5],
                'current_amount' => 92000000,
                'donor_count' => 567,
            ],
            [
                'program_name' => 'PKH - Perlindungan Anak Jalanan',
                'description' => 'Program perlindungan dan pemberdayaan anak jalanan agar dapat mengakses pendidikan dan layanan kesehatan.',
                'target_amount' => 95000000,
                'start_date' => '2026-04-01',
                'end_date' => '2026-12-31',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=800',
                'created_by' => 4,
                'categories' => [2, 5],
                'current_amount' => 34500000,
                'donor_count' => 289,
            ],
            [
                'program_name' => 'Banjir Jakarta 2026 - Respons Darurat',
                'description' => 'Bantuan respons darurat untuk korban banjir besar di Jakarta dan sekitarnya.',
                'target_amount' => 400000000,
                'start_date' => '2026-04-10',
                'end_date' => '2026-05-31',
                'status' => 'active',
                'image_url' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=800',
                'created_by' => 1,
                'categories' => [3, 5],
                'current_amount' => 289000000,
                'donor_count' => 2156,
            ],
            [
                'program_name' => 'Kitabisa - Kampanye Selesai',
                'description' => 'Contoh kampanye yang sudah selesai untuk menunjukkan transparansi.',
                'target_amount' => 50000000,
                'start_date' => '2025-06-01',
                'end_date' => '2025-12-31',
                'status' => 'completed',
                'image_url' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb6?w=800',
                'created_by' => 2,
                'categories' => [1],
                'current_amount' => 52000000,
                'donor_count' => 520,
            ],
        ];

        foreach ($programs as $data) {
            $categories = $data['categories'];
            $currentAmount = $data['current_amount'];
            $donorCount = $data['donor_count'];
            unset($data['categories'], $data['current_amount'], $data['donor_count']);

            $program = Program::create($data);

            ProgramCampaign::create([
                'program_id' => $program->program_id,
                'current_amount' => $currentAmount,
                'available_balance' => $currentAmount * 0.85,
                'donor_count' => $donorCount,
            ]);

            foreach ($categories as $categoryId) {
                ProgramCategoryMapping::create([
                    'program_id' => $program->program_id,
                    'category_id' => $categoryId,
                ]);
            }
        }
    }
}