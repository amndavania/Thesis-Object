<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; //ini ilangin untuk tes manual | mereset database ke keadaan bersih sebelum setiap test method dijalankan
use Tests\TestCase;
use App\Models\Student;
use App\Models\Ukt;
use App\Models\BimbinganStudy;
use Database\Seeders\StudentTypeSeeder;
use Database\Seeders\FacultiesSeeder;
use Database\Seeders\StudyProgramsSeeder;
use Database\Seeders\DpaSeeder;
use Database\Seeders\UsersSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class CekPembayaranControllerTest extends TestCase
{
    use RefreshDatabase; //ini juga

    /** @test */
    public function it_returns_data_view_with_valid_student_data()
    {
        // Seed semua yang diperlukan
        $this->seed(FacultiesSeeder::class);
        $this->seed(StudyProgramsSeeder::class);
        $this->seed(StudentTypeSeeder::class);
        $this->seed(UsersSeeder::class);
        $this->seed(DpaSeeder::class);

        // Ambil entitas yang dibutuhkan
        $dpa = \App\Models\Dpa::first();
        $studyProgram = \App\Models\StudyProgram::first();
        $studentType = \App\Models\StudentType::first();

        // Buat student
        $student = Student::factory()->create([
            'name' => 'Budi',
            'nim' => '12345678',
            'study_program_id' => $studyProgram->id,
            'student_types_id' => $studentType->id,
            'dpa_id' => $dpa->id,
        ]);

        // Buat ukt
        $ukt = Ukt::factory()->create([
            'students_id' => $student->id,
            'semester' => 'GENAP',
            'year' => 2023,
        ]);

        // Request
        $response = $this->get(route('cekpembayaran.data', [
            'students_id' => $student->id,
            'nim' => '12345678',
            'name' => 'Budi',
        ]));

        // Assertion
        $response->assertStatus(200);
        $response->assertViewIs('cek_detail_payment.data'); //view yang ingin ditampilkan
        $response->assertViewHasAll([
            'ukt', 'students', 'choice', 'isValid'
        ]);
        $response->assertViewHas('isValid', true);
    }

    /** @test */
    public function it_can_export_lbs_report()
    {
        // Seed semua yang diperlukan
        $this->seed(FacultiesSeeder::class);
        $this->seed(StudyProgramsSeeder::class);
        $this->seed(StudentTypeSeeder::class);
        $this->seed(UsersSeeder::class);
        $this->seed(DpaSeeder::class);

        $dpa = \App\Models\Dpa::first();
        $studyProgram = \App\Models\StudyProgram::first();
        $studentType = \App\Models\StudentType::first();

        // Student
        $student = Student::factory()->create([
            'force' => 2020,
            'study_program_id' => $studyProgram->id,
            'student_types_id' => $studentType->id,
            'dpa_id' => $dpa->id,
        ]);

        // Bimbingan Studi
        $bimbingan = BimbinganStudy::factory()->create([
            'students_id' => $student->id,
            'year' => 2024,
            'semester' => 'GENAP',
        ]);

        // Request ke exportLBS
        $response = $this->get(route('cekpembayaran.exportLBS', [
            'id' => $bimbingan->id,
        ]));        

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.krs');
        $response->assertViewHasAll([
            'bimbinganstudi',
            'student',
            'semester',
            'title',
            'today',
        ]);

        $response->assertViewHas('title', 'Lembar Bimbingan Studi');
        // ((2024 - 2020) * 2) + 2 = 10
        $response->assertViewHas('semester', 10);
    }
}
