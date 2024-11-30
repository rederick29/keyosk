<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Sohail is the admin, the leader.
        User::factory()->create([
            'name' => 'sohail',
            'email' => 'sohail@aston.ac.uk',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
        ]);

        // Richard is Sohail's favourite subject.
        User::factory()->create([
            'name' => 'richard',
            'email' => 'testuser@example.com',
            'password' => Hash::make(env('TEST_PASSWORD', 'password')),
        ]);

        User::factory(10)->create();
    }
}
