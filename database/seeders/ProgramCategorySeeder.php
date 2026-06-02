<?php

namespace Database\Seeders;

use App\Models\ProgramCategory;
use Illuminate\Database\Seeder;

class ProgramCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Kesehatan',
                'description' => 'Program kesehatan untuk membantu biaya pengobatan, operasi, dan perawatan medis bagi yang membutuhkan',
                'icon_url' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=200',
            ],
            [
                'category_name' => 'Pendidikan',
                'description' => 'Program pendidikan untuk membantu biaya sekolah, scholarships, dan pengembangan kapasitas anak-anak kurang mampu',
                'icon_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=200',
            ],
            [
                'category_name' => 'Bencana Alam',
                'description' => 'Bantuan darurat bagi korban bencana alam seperti banjir, gempa bumi, gunung berapi, dan lainnya',
                'icon_url' => 'https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?w=200',
            ],

            [
                'category_name' => 'Sosial',
                'description' => 'Program bantuan sosial untuk komunitas, panti asuhan, lanjut usia, dan kelompok rentan lainnya',
                'icon_url' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=200',
            ],
            [
                'category_name' => 'Lingkungan',
                'description' => 'Program pelestarian lingkungan, reboisasi, dan pengelolaan sampah',
                'icon_url' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?w=200',
            ],

        ];

        foreach ($categories as $category) {
            ProgramCategory::create($category);
        }
    }
}