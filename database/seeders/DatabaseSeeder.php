<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(5)
            ->sequence(function (Sequence $sequence) {

                $role = $sequence->index === 0 ? 'admin' : 'user';

                return [
                    'email' => $role . '.' . ($sequence->index + 1) . '@example.com',
                    'role' => $role
                ];

            })
            ->create();

        Project::factory(5)
            ->has(
                Task::factory(rand(3, 6))
                    ->hasAttached($users->take(rand(0, 3)))
            )
            ->create();

    }
}
