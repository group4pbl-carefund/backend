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
                'nama_donatur' => 'Ahmad Fauzi',
                'nominal' => 500000,
                'metode_pembayaran' => 'transfer_bank',
                'pesan' => 'Semangat untuk anak-anak yang membutuhkan!',
                'status' => 'success',
                'created_at' => '2026-01-05 10:30:00',
            ],
            [
                'nama_donatur' => 'Siti Nurhaliza',
                'nominal' => 1000000,
                'metode_pembayaran' => 'e_wallet',
                'pesan' => 'Semoga membantu saudara kita yang membutuhkan',
                'status' => 'success',
                'created_at' => '2026-01-06 14:20:00',
            ],
            [
                'nama_donatur' => 'Budi Santoso',
                'nominal' => 250000,
                'metode_pembayaran' => 'credit_card',
                'pesan' => 'Terima kasih Carefund atas platformnya',
                'status' => 'success',
                'created_at' => '2026-01-07 09:15:00',
            ],
            [
                'nama_donatur' => 'Dewi Lestari',
                'nominal' => 750000,
                'metode_pembayaran' => 'transfer_bank',
                'pesan' => 'Bangga bisa berkontribusi untuk pendidikan',
                'status' => 'success',
                'created_at' => '2026-01-08 16:45:00',
            ],
            [
                'nama_donatur' => 'Rico Hermawan',
                'nominal' => 1500000,
                'metode_pembayaran' => 'e_wallet',
                'pesan' => 'Untuk kesehatan anak-anak Indonesia',
                'status' => 'success',
                'created_at' => '2026-01-10 11:00:00',
            ],
            [
                'nama_donatur' => 'Nila Safitri',
                'nominal' => 300000,
                'metode_pembayaran' => 'transfer_bank',
                'pesan' => null,
                'status' => 'success',
                'created_at' => '2026-01-12 08:30:00',
            ],
            [
                'nama_donatur' => 'Joko Pramono',
                'nominal' => 200000,
                'metode_pembayaran' => 'credit_card',
                'pesan' => 'Sedikit dari saya untuk mereka',
                'status' => 'pending',
                'created_at' => '2026-04-10 15:20:00',
            ],
            [
                'nama_donatur' => 'Rina Kusuma',
                'nominal' => 800000,
                'metode_pembayaran' => 'e_wallet',
                'pesan' => 'Semoga menjadi keberkahan',
                'status' => 'success',
                'created_at' => '2026-01-15 12:00:00',
            ],
            [
                'nama_donatur' => 'Hendra Wijaya',
                'nominal' => 500000,
                'metode_pembayaran' => 'transfer_bank',
                'pesan' => 'Untuk kampanye ini',
                'status' => 'failed',
                'created_at' => '2026-04-09 10:45:00',
            ],
            [
                'nama_donatur' => 'Anonymous',
                'nominal' => 100000,
                'metode_pembayaran' => 'e_wallet',
                'pesan' => 'Terus semangat!',
                'status' => 'success',
                'created_at' => '2026-01-18 17:30:00',
            ],
            [
                'nama_donatur' => 'Anonymous',
                'nominal' => 2000000,
                'metode_pembayaran' => 'transfer_bank',
                'pisat' => 'Bantuan untuk korban bencana',
                'status' => 'success',
                'created_at' => '2026-01-20 09:00:00',
            ],
            [
                'nama_donatur' => 'PT Maju Jaya',
                'nominal' => 5000000,
                'metode_pembayaran' => 'transfer_bank',
                'pesan' => 'CSR dari PT Maju Jaya',
                'status' => 'success',
                'created_at' => '2026-01-25 14:00:00',
            ],
            [
                'nama_donatur' => 'Donatur Rahasia',
                'nominal' => 1000000,
                'metode_pembayaran' => 'credit_card',
                'pesan' => null,
                'status' => 'pending',
                'created_at' => '2026-04-10 16:00:00',
            ],
            [
                'nama_donatur' => 'Siti Aminah',
                'nominal' => 350000,
                'metode_pembayaran' => 'e_wallet',
                'pisat' => 'JazakAllah khair',
                'status' => 'success',
                'created_at' => '2026-02-01 10:30:00',
            ],
            [
                'nama_donatur' => 'Muhammad Yusuf',
                'nominal' => 1200000,
                'metode_pembayaran' => 'transfer_bank',
                'pisat' => 'Untuk anak-anak yang membutuhkan',
                'status' => 'success',
                'created_at' => '2026-02-05 13:15:00',
            ],
            [
                'nama_donatur' => 'Lembaga Zakat Indonesia',
                'nominal' => 10000000,
                'metode_pembayaran' => 'transfer_bank',
                'pisat' => 'Zakat dari LZI',
                'status' => 'success',
                'created_at' => '2026-02-10 08:00:00',
            ],
            [
                'nama_donatur' => 'Anonymous',
                'nominal' => 450000,
                'metode_pembayaran' => 'credit_card',
                'pisat' => 'Semoga membantu',
                'status' => 'success',
                'created_at' => '2026-02-15 15:30:00',
            ],
            [
                'nama_donatur' => 'Bpk. Hartono',
                'nominal' => 2500000,
                'metode_pembayaran' => 'transfer_bank',
                'pisat' => 'Infak shodaqoh',
                'status' => 'success',
                'created_at' => '2026-02-20 11:00:00',
            ],
            [
                'nama_donatur' => 'Ibu Maryati',
                'nominal' => 175000,
                'metode_pembayaran' => 'e_wallet',
                'pisat' => null,
                'status' => 'failed',
                'created_at' => '2026-04-08 09:45:00',
            ],
            [
                'nama_donatur' => 'CV Sejahtera',
                'nominal' => 3000000,
                'metode_pembayaran' => 'transfer_bank',
                'pisat' => 'Bantuan CSR',
                'status' => 'success',
                'created_at' => '2026-03-01 10:00:00',
            ],
        ];

        foreach ($donations as $donation) {
            Donation::create($donation);
        }
    }
}