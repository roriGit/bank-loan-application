<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserPersonal;
use App\Models\Application;
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
        // Create 5 users
        User::factory(5)->create()->each(function($user) {

            // Create one personal info for each user
            UserPersonal::factory()->create([
                'users_id' => $user->id,
            ]);

            // Create 1-3 applications for each user
            Application::factory(rand(1, 3))->create([
                'users_id' => $user->id,
            ]);
        });
    }
}
