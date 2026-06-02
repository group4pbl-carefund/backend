<?php

namespace Database\Seeders;

use App\Models\EducationArticle;
use Illuminate\Database\Seeder;

class EducationArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Cara Berdonasi yang Aman dan Terpercaya',
                'content' => 'Panduan lengkap tentang cara berdonasi secara aman melalui platform terpercaya. Pelajari bagaimana memverifikasi keaslian kampanye, memahami transparansi dana, dan menghindari penipuan.

1. Pilih platform terpercaya dengan sistem verifikasi yang ketat
2. Periksa detail kampanye sebelum berdonasi
3. Simpan bukti transaksi untuk keamanan
4. Pantau perkembangan kampanye yang telah didukung',
                'category' => 'Security',
                'author_id' => 1,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400',
                'status' => 'published',
                'published_at' => '2026-01-15 08:00:00',
                'read_time' => 5,
            ],
            [
                'title' => 'Memahami Sistem Zakat dalam Islam',
                'content' => 'Zakat merupakan salah satu rukun Islam yang memiliki aturan spesifik. Artikel ini menjelaskan jenis-jenis zakat, syarat-syaratnya, dan hikmah di balik perintah Allah SWT untuk mengeluarkan zakat.

Zakat terdiri dari:
- Zakat Fitrah: Dibayarkan pada bulan Ramadan
- Zakat Mal: Dari kekayaan yang telah mencapai nisab
- Zakat Fidyah: Ganti makanan untuk orang yang tidak mampu puasa',
                'category' => 'Regulation',
                'author_id' => 2,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1577953138796-f5ae8c0e9c80?w=400',
                'status' => 'published',
                'published_at' => '2026-02-10 10:30:00',
                'read_time' => 8,
            ],
            [
                'title' => 'Dampak Positif Berdonasi bagi Kesehatan',
                'content' => 'Tahukah Anda bahwa berdonasi tidak hanya membantu orang lain tetapi juga memberikan manfaat bagi kesehatan mental dan emosional Anda? Berikut penjelasannya.

Penelitian menunjukkan bahwa:
- Berdonasi meningkatkan merasa puas dan bahagia
- Mengurangi stres dan kecemasan
- Membuat merasa lebih terhubung dengan komunitas
- Meningkatkan rasa syukur',
                'category' => 'Payment',
                'author_id' => 1,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1559757148-5c350d0d3c21?w=400',
                'status' => 'published',
                'published_at' => '2026-03-05 14:00:00',
                'read_time' => 6,
            ],
            [
                'title' => 'Tips Memilih Kampanye yang Valid',
                'content' => 'Dengan begitu banyak kampanye penggalangan dana, bagaimana membedakan mana yang valid dan mana yang palsu? Berikut panduan lengkapnya.

1. Periksa kelengkapan dokumen kampanye
2. Cari informasi tentang pembuat kampanye
3. Baca testimoni dari donatur sebelumnya
4. Pantau transparansi penggunaan dana',
                'category' => 'Security',
                'author_id' => 3,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1553729459-efe14ef6055d?w=400',
                'status' => 'published',
                'published_at' => '2026-03-20 09:15:00',
                'read_time' => 7,
            ],
            [
                'title' => 'Program Scholarships Indonesia 2026',
                'content' => 'Informasi lengkap tentang berbagai program scholarships yang tersedia di Indonesia untuk jenjang SD, SMP, SMA, dan Kuliah.

Jenis scholarships yang tersedia:
1. Scholarships pemerintah (Bidikmisi, etc)
2. Scholarships dari universitas
3. Scholarships dari perusahaan
4. Scholarships dari organisasi sosial',
                'category' => 'Regulation',
                'author_id' => 2,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400',
                'status' => 'published',
                'published_at' => '2026-04-01 11:00:00',
                'read_time' => 10,
            ],
            [
                'title' => 'Cara Membuat Kampanye Penggalangan Dana',
                'content' => 'Panduan langkah demi langkah untuk membuat kampanye penggalangan dana yang berhasil dan terpercaya.

Langkah-langkah:
1. Daftar sebagai pembuat kampanye
2. Lengkapi verifikasi identitas
3. Tulis deskripsi kampanye yang jelas
4. Unggah foto/video pendukung
5. Tetapkan target realistis
6. Sebarkan ke jaringan Anda',
                'category' => 'Payment',
                'author_id' => 1,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=400',
                'status' => 'published',
                'published_at' => '2026-04-10 16:30:00',
                'read_time' => 12,
            ],
            [
                'title' => 'Menjadi Relawan: Pengalaman yang Membanggakan',
                'content' => 'Kisah inspiratif dari para relawan yang telah membantu berbagai kampanye sosial. Temukan motivasi dan manfaat menjadi relawan.

Bergabung dengan sukarelawan memberikan:
- Kesempatan membantu sesama
- Pengembangan keterampilan
- Jaringan pertemanan baru
- Kepuasan batin',
                'category' => 'Security',
                'author_id' => 3,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=400',
                'status' => 'published',
                'published_at' => '2026-04-15 13:45:00',
                'read_time' => 6,
            ],
            [
                'title' => 'Pentingnya Transparansi dalam Penggalangan Dana',
                'content' => 'Transparansi adalah kunci kepercayaan dalam penggalangan dana. Pelajari bagaimana platform terpercaya menjaga transparansi.

Elemen transparansi:
1. Laporan penggunaan dana berkala
2. Verifikasi independent
3. Akses donatur untuk melihat perkembangan
4.Audit berkala',
                'category' => 'Regulation',
                'author_id' => 1,
                'thumbnail_url' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=400',
                'status' => 'draft',
                'published_at' => null,
                'read_time' => 8,
            ],
        ];

        foreach ($articles as $article) {
            EducationArticle::create($article);
        }
    }
}