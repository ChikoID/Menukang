<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Create (or update) the default administrator account.
     *
     * Safe to run multiple times: the account is matched by email.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@menukang.test'],
            [
                'name' => 'Administrator',
                'password' => 'password',
                'role' => 'admin',
                'email_verified_at' => now(),
            ],
        );
    }
}
