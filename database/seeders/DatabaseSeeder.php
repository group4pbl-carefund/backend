<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            UserIdentitySeeder::class,
            UserSessionSeeder::class,
            TermVersionSeeder::class,
            UserTermsAgreementSeeder::class,
            ProgramCategorySeeder::class,
            ProgramSeeder::class,
            DonationSeeder::class,
            PaymentLogSeeder::class,
            EducationArticleSeeder::class,
            EducationViewSeeder::class,
            UnapprovedCampaignSeeder::class,
        ]);
    }
}
