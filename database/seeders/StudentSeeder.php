<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudyProgram;
use App\Models\Dpa;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Buat data pendukung (foreign key)
        $studentType = StudentType::factory()->create();
        $studyProgram = StudyProgram::factory()->create();
        $dpa = Dpa::factory()->create();

        // Buat 5 student
        Student::factory()->count(5)->create([
            'student_types_id' => $studentType->id,
            'study_program_id' => $studyProgram->id,
            'dpa_id' => $dpa->id,
        ]);
    }
}
