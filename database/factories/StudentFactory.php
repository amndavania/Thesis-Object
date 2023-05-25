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
            'nim'=>fake()->uuid(),
            'study_program_id'=>mt_rand(1,10),
            'force'=>fake()->word(),
            'student_types_id'=>mt_rand(1,10),
        ];
    }
}
