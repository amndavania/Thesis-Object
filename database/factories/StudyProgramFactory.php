<?php

namespace Database\Factories;

use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Faculty;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentProgram>
 */
class StudyProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Ilmu ".fake()->word(),
            'kaprodi_name' => fake()->name(),
            'faculty_id' => Faculty::factory(), // otomatis buat data faculty
            // 'faculty_id' => mt_rand(1,5),
        ];
    }
}
