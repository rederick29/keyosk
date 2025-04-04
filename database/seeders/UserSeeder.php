<?php

namespace Database\Seeders;

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
        // Sohail is the admin, the leader.
        $user = User::factory()->create([
            'first_name' => 'sohail',
            'last_name' => 'admin',
            'email' => 'sohail@aston.ac.uk',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password'))
        ]);

        // Sohail is the admin, the leader.
        $user->is_admin = true;
        $user->save();

        // Richard is Sohail's favourite subject.
        User::factory()->create([
            'first_name' => 'richard',
            'last_name' => 'the best',
            'email' => 'richard@aston.ac.uk',
            'password' => Hash::make(env('TEST_PASSWORD', 'password')),
        ]);

        if (!App::isProduction()) {
            User::factory(10)->create();
        }
    }
}
