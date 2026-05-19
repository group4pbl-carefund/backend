<?php

namespace Database\Seeders;

use App\Models\EducationArticle;
use App\Models\EducationView;
use Illuminate\Database\Seeder;

class EducationViewSeeder extends Seeder
{
    public function run(): void
    {
        $articles = EducationArticle::where('status', 'published')->get();
        $users = \App\Models\User::where('is_verified', true)->pluck('id')->toArray();

        $views = [
            ['article_id' => 1, 'user_id' => 2, 'viewed_at' => '2026-01-15 09:30:00'],
            ['article_id' => 1, 'user_id' => 3, 'viewed_at' => '2026-01-15 10:15:00'],
            ['article_id' => 1, 'user_id' => 4, 'viewed_at' => '2026-01-16 08:45:00'],
            ['article_id' => 1, 'user_id' => 5, 'viewed_at' => '2026-01-17 14:20:00'],
            ['article_id' => 1, 'user_id' => 6, 'viewed_at' => '2026-01-18 11:00:00'],
            ['article_id' => 1, 'user_id' => 7, 'viewed_at' => '2026-01-19 16:30:00'],
            ['article_id' => 1, 'user_id' => null, 'viewed_at' => '2026-01-20 09:00:00'],
            ['article_id' => 1, 'user_id' => null, 'viewed_at' => '2026-01-21 13:45:00'],
            ['article_id' => 2, 'user_id' => 2, 'viewed_at' => '2026-02-11 08:00:00'],
            ['article_id' => 2, 'user_id' => 3, 'viewed_at' => '2026-02-12 10:30:00'],
            ['article_id' => 2, 'user_id' => 4, 'viewed_at' => '2026-02-13 15:00:00'],
            ['article_id' => 2, 'user_id' => 8, 'viewed_at' => '2026-02-14 09:20:00'],
            ['article_id' => 2, 'user_id' => 9, 'viewed_at' => '2026-02-15 11:45:00'],
            ['article_id' => 2, 'user_id' => null, 'viewed_at' => '2026-02-16 14:10:00'],
            ['article_id' => 3, 'user_id' => 3, 'viewed_at' => '2026-03-06 09:00:00'],
            ['article_id' => 3, 'user_id' => 5, 'viewed_at' => '2026-03-07 10:30:00'],
            ['article_id' => 3, 'user_id' => 6, 'viewed_at' => '2026-03-08 13:15:00'],
            ['article_id' => 3, 'user_id' => 7, 'viewed_at' => '2026-03-09 08:45:00'],
            ['article_id' => 3, 'user_id' => 9, 'viewed_at' => '2026-03-10 16:00:00'],
            ['article_id' => 3, 'user_id' => null, 'viewed_at' => '2026-03-11 12:30:00'],
            ['article_id' => 4, 'user_id' => 2, 'viewed_at' => '2026-03-21 08:30:00'],
            ['article_id' => 4, 'user_id' => 4, 'viewed_at' => '2026-03-22 09:45:00'],
            ['article_id' => 4, 'user_id' => 5, 'viewed_at' => '2026-03-23 14:20:00'],
            ['article_id' => 4, 'user_id' => 8, 'viewed_at' => '2026-03-24 10:00:00'],
            ['article_id' => 4, 'user_id' => null, 'viewed_at' => '2026-03-25 15:30:00'],
            ['article_id' => 5, 'user_id' => 3, 'viewed_at' => '2026-04-02 09:00:00'],
            ['article_id' => 5, 'user_id' => 6, 'viewed_at' => '2026-04-03 11:30:00'],
            ['article_id' => 5, 'user_id' => 7, 'viewed_at' => '2026-04-04 08:15:00'],
            ['article_id' => 5, 'user_id' => 9, 'viewed_at' => '2026-04-05 13:45:00'],
            ['article_id' => 5, 'user_id' => 10, 'viewed_at' => '2026-04-06 10:20:00'],
            ['article_id' => 6, 'user_id' => 2, 'viewed_at' => '2026-04-11 09:30:00'],
            ['article_id' => 6, 'user_id' => 4, 'viewed_at' => '2026-04-12 14:00:00'],
            ['article_id' => 6, 'user_id' => 5, 'viewed_at' => '2026-04-13 11:15:00'],
            ['article_id' => 6, 'user_id' => 8, 'viewed_at' => '2026-04-14 16:45:00'],
            ['article_id' => 7, 'user_id' => 3, 'viewed_at' => '2026-04-16 08:00:00'],
            ['article_id' => 7, 'user_id' => 6, 'viewed_at' => '2026-04-17 10:30:00'],
            ['article_id' => 7, 'user_id' => 7, 'viewed_at' => '2026-04-18 13:00:00'],
            ['article_id' => 7, 'user_id' => 9, 'viewed_at' => '2026-04-19 15:30:00'],
            ['article_id' => 7, 'user_id' => null, 'viewed_at' => '2026-04-20 09:45:00'],
        ];

        foreach ($views as $view) {
            EducationView::create($view);
        }
    }
}