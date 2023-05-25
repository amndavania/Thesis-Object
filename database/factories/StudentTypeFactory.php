<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentType>
 */
class StudentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type'=>fake()->word(),
            'dpp'=>fake()->randomFloat(1, 10, 30),
            'krs'=>fake()->randomFloat(1, 10, 30),
            'uts'=>fake()->randomFloat(1, 10, 30),
            'wisuda'=>fake()->randomFloat(1, 10, 30),
        ];
    }
}
