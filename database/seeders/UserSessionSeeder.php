<?php

namespace Database\Seeders;

use App\Models\UserSession;
use Illuminate\Database\Seeder;

class UserSessionSeeder extends Seeder
{
    public function run(): void
    {
        $sessions = [
            [
                'user_id' => 2,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIyIiwiZXhwIjoxNzA0MDUwMDAwfQ.x1234567890abcdefghijklmnopqrstuvwxyz',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
                'login_at' => '2026-04-10 08:30:00',
                'expires_at' => '2026-04-11 08:30:00',
                'ip_address' => '192.168.1.101',
            ],
            [
                'user_id' => 3,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIzIiwiZXhwIjoxNzA0MDUwMDAwfQ.yzabcdefghijklmnopqrstuvwxyz1234567890',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Safari/605.1.15',
                'login_at' => '2026-04-10 09:15:00',
                'expires_at' => '2026-04-11 09:15:00',
                'ip_address' => '192.168.1.102',
            ],
            [
                'user_id' => 4,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI0IiwiZXhwIjoxNzA0MDUwMDAwfQ.1234567890abcdefghijklmnopqrstuvwxyz',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) Safari/604.1',
                'login_at' => '2026-04-10 10:00:00',
                'expires_at' => '2026-04-11 10:00:00',
                'ip_address' => '192.168.1.103',
            ],
            [
                'user_id' => 5,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI1IiwiZXhwIjoxNzA0MDUwMDAwfQ.abcdefghijklmnopqrstuvwxyz1234567890',
                'user_agent' => 'Mozilla/5.0 (Android 13) Chrome/120.0.0.0 Mobile',
                'login_at' => '2026-04-10 11:30:00',
                'expires_at' => '2026-04-11 11:30:00',
                'ip_address' => '192.168.1.104',
            ],
            [
                'user_id' => 1,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxIiwiZXhwIjoxNzA0MDUwMDAwfQ.zyxwvutsrqponmlkjihgfedcba9876543210',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0',
                'login_at' => '2026-04-10 07:00:00',
                'expires_at' => '2026-04-10 19:00:00',
                'ip_address' => '192.168.1.100',
            ],
            [
                'user_id' => 6,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI2IiwiZXhwIjoxNzA0MDUwMDAwfQ.qwertyuiopasdfghjklzxcvbnm1234567890',
                'user_agent' => 'Mozilla/5.0 (Linux; x86_64) Firefox/121.0',
                'login_at' => '2026-04-09 14:20:00',
                'expires_at' => '2026-04-10 14:20:00',
                'ip_address' => '192.168.1.105',
            ],
            [
                'user_id' => 7,
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Edge/120.0.0.0',
                'login_at' => '2026-04-08 16:45:00',
                'expires_at' => null,
                'ip_address' => '192.168.1.106',
            ],
            [
                'user_id' => 9,
                'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiI5IiwiZXhwIjoxNzA0MDUwMDAwfQ.lkjhgfdsa1234567890qwertyuiopzxcvbnm',
                'user_agent' => 'Mozilla/5.0 (iPad; CPU OS 17_0 like Mac OS X) Safari/604.1',
                'login_at' => '2026-04-10 08:00:00',
                'expires_at' => '2026-04-11 08:00:00',
                'ip_address' => '192.168.1.108',
            ],
        ];

        foreach ($sessions as $session) {
            UserSession::create($session);
        }
    }
}