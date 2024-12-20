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

        /**
         * Create 1 admin and 4 normal users
         */
        $users = User::factory(5)
            ->sequence(function (Sequence $sequence) {

                $role = $sequence->index === 0 ? 'admin' : 'user';

                return [
                    'email' => $role . '.' . ($sequence->index + 1) . '@example.com',
                    'role' => $role
                ];

            })
            ->create();

        /**
         * Create projects
         */
        $projects = Project::factory(5)
            ->create();

        /**
         * Create random amount of tasks to each project which are assigned to random amount of users.
         */
        foreach($projects as $project) {

            Task::factory(rand(3, 6))
                ->create([
                    'project_id' => $project->id,
                ])
                ->each(function ($task) use ($users) {

                    foreach($users->shuffle()->take(rand(0, 3)) as $user) {

                        $task->users()->attach($user);

                    }

                });

        }

    }
}
