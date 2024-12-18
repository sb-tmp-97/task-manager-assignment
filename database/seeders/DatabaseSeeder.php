<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'role' => 'manager',
            'email' => 'admin@example.com',
        ]);

        User::factory()->create([
            'name' => 'First Normal User',
            'role' => 'user',
            'email' => 'user1@example.com',
        ]);

        User::factory()->create([
            'name' => 'Second Normal User',
            'role' => 'user',
            'email' => 'user2@example.com',
        ]);

        Project::factory(5)
            ->has(
                Task::factory()
                    ->hasUsers(rand(1, 2))
                    ->count(rand(3, 6))
            )
            ->create();

    }
}
