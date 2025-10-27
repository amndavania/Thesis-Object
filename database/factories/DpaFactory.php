<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\StudyProgram;
use App\Models\Dpa;
use Illuminate\Database\Eloquent\Factories\Factory;

class DpaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Dpa::class;

    public function definition(): array
    {
         return [
            'name' => "Dosen ".fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'user_id' => User::factory(), // otomatis buat user baru
            'study_program_id' => StudyProgram::factory(), // otomatis buat study program baru
            // 'user_id'=> fake()->unique()->numberBetween(4,43),
            // 'study_program_id'=>mt_rand(1,13),
        ];  
    }
}
