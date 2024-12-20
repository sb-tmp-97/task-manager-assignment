<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(rand(1, 4), true),
            'description' => implode('<br><br>', fake()->paragraphs(2)), // basic html description
            'completed' => fake()->boolean(),
            'due_date' => fake()->boolean() ?  now()->addDays(rand(2, 14)) : null, // optional due date
        ];
    }
}
