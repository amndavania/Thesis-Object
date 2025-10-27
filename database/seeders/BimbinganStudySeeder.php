<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BimbinganStudy;
use App\Models\Student;

class BimbinganStudySeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada data student
        if (Student::count() == 0) {
            $this->call(StudentSeeder::class);
        }

        $students = Student::all();

        foreach ($students as $student) {
            BimbinganStudy::factory()->create([
                'students_id' => $student->id,
                'year' => '2024',
                'semester' => 'GENAP',
                'status' => 'Tunda',
            ]);
        }
    }
}
