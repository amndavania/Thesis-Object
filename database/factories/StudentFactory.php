<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->name(),
            'nim'=>fake()->randomNumber(8, true),
            'force'=>fake()->numberBetween(1990, 2023),
            'study_program_id'=>mt_rand(1,13),
            'student_types_id'=>mt_rand(1,5),
            'dpa_id'=>mt_rand(1,40),
        ];
    }
}
