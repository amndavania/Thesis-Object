<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamCard;
use App\Models\Student;

class ExamCardSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan sudah ada student
        if (Student::count() == 0) {
            $this->call(StudentSeeder::class);
        }

        // Buat exam card untuk 10 mahasiswa acak
        $students = Student::all();

        foreach ($students as $student) {
            ExamCard::factory()->create([
                'students_id' => $student->id,
                'type' => 'UTS',
                'semester' => 'GENAP',
                'year' => 2024,
            ]);

            ExamCard::factory()->create([
                'students_id' => $student->id,
                'type' => 'UAS',
                'semester' => 'GENAP',
                'year' => 2024,
            ]);
        }
    }
}
