<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'sohail',
            'email' => 'admin@example.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
        ]);

        User::factory()->create([
            'name' => 'richard',
            'email' => 'testuser@example.com',
            'password' => Hash::make(env('TEST_PASSWORD', 'password')),
        ]);
        User::factory(10)->create();
    }
}
