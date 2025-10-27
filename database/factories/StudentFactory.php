<?php

namespace Database\Factories;

use App\Models\Dpa;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudyProgram;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'nim' => $this->faker->unique()->numerify('########'),
            'force' => $this->faker->year,
            'study_program_id' => StudyProgram::factory(),
            'student_types_id' => StudentType::factory(),
            'dpa_id' => Dpa::factory(),
        ];
    }
}
