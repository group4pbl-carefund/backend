<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserTermsAgreement;
use Illuminate\Database\Seeder;

class UserTermsAgreementSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('is_verified', true)->get();

        $agreements = [
            ['version_id' => 1, 'agreed_at' => '2026-01-15 10:30:00', 'ip_address' => '192.168.1.101'],
            ['version_id' => 1, 'agreed_at' => '2026-01-20 14:22:00', 'ip_address' => '192.168.1.102'],
            ['version_id' => 1, 'agreed_at' => '2026-01-25 09:15:00', 'ip_address' => '192.168.1.103'],
            ['version_id' => 1, 'agreed_at' => '2026-02-01 16:45:00', 'ip_address' => '192.168.1.104'],
            ['version_id' => 2, 'agreed_at' => '2026-03-16 11:00:00', 'ip_address' => '192.168.1.105'],
            ['version_id' => 2, 'agreed_at' => '2026-03-18 13:30:00', 'ip_address' => '192.168.1.106'],
            ['version_id' => 2, 'agreed_at' => '2026-03-20 08:45:00', 'ip_address' => '192.168.1.107'],
            ['version_id' => 2, 'agreed_at' => '2026-03-25 15:20:00', 'ip_address' => '192.168.1.108'],
            ['version_id' => 3, 'agreed_at' => '2026-04-02 10:00:00', 'ip_address' => '192.168.1.109'],
            ['version_id' => 3, 'agreed_at' => '2026-04-05 12:30:00', 'ip_address' => '192.168.1.110'],
            ['version_id' => 3, 'agreed_at' => '2026-04-08 09:15:00', 'ip_address' => '192.168.1.111'],
            ['version_id' => 3, 'agreed_at' => '2026-04-10 14:45:00', 'ip_address' => '192.168.1.112'],
        ];

        $index = 0;
        foreach ($users as $user) {
            if ($index < count($agreements)) {
                UserTermsAgreement::create([
                    'user_id' => $user->id,
                    'version_id' => $agreements[$index]['version_id'],
                    'agreed_at' => $agreements[$index]['agreed_at'],
                    'ip_address' => $agreements[$index]['ip_address'],
                ]);
                $index++;
            }
        }
    }
}