<?php

namespace Database\Factories;

use App\Models\StudyProgram;
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
            'type' => fake()->unique()->word(),
            'dpp'=>fake()->numberBetween(100000, 1000000),
            'krs'=>fake()->numberBetween(100000, 1000000),
            'uts'=>fake()->numberBetween(100000, 1000000),
            'uas'=>fake()->numberBetween(100000, 1000000),
            'wisuda'=>fake()->numberBetween(100000, 1000000),
            'year'=>fake()->numberBetween(1996,2023),
            'study_program_id' => StudyProgram::factory(), // ✅ ini aman karena langsung buat 1
        ];
    }
}
