<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dpa;
use App\Models\User;
use App\Models\Ukt;
use App\Models\Student;
use App\Models\ExamCard;
use App\Models\BimbinganStudy;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DpaAcademicControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsDpa()
    {
        $user = User::factory()->create(['role' => 'DPA']);
        $dpa = Dpa::factory()->create(['user_id' => $user->id]);
        return [$this->actingAs($user), $dpa];
    }

    /** @test */
    public function it_loads_mahasiswa_list_page()
    {
        [$client, $dpa] = $this->actingAsDpa();

        Student::factory()->create(['dpa_id' => $dpa->id]);

        $response = $client->get(route('daftar_mahasiswa', [
            'dpa_id' => $dpa->id,
            'year' => '2024',
            'semester' => 'GENAP'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('dpa.daftarmahasiswa');
        $response->assertViewHas('data');
    }

    /** @test */
    public function it_can_approve_or_reject_krs()
    {
        [$client, $dpa] = $this->actingAsDpa();

        $student = Student::factory()->create(['dpa_id' => $dpa->id]);
        $bimbingan = BimbinganStudy::factory()->create([
            'students_id' => $student->id,
            'year' => '2024',
            'semester' => 'GENAP',
            'status' => 'Tidak Aktif'
        ]);

        $ukt = Ukt::factory()->create([
            'students_id' => $student->id,
            'semester' => 'GENAP',
            'year' => '2024',
            'status' => 'Lunas',
        ]);

        $response = $client->get(route('daftar_mahasiswa', [
            'student_id' => $student->id,
            'lbs_id' => $bimbingan->id,
            'status' => 'Aktif',
            'year' => '2024',
            'semester' => 'GENAP'
        ]));

        $response->assertStatus(200);
        $this->assertDatabaseHas('bimbingan_study', [
            'id' => $bimbingan->id,
            'status' => 'Aktif'
        ]);

        $this->assertDatabaseHas('ukts', [
            'students_id' => $student->id,
            'semester' => 'GENAP',
            'year' => '2024',
        ]);
    }

    /** @test */
    public function it_handles_create_new_bimbingan_if_id_empty()
    {
        [$client, $dpa] = $this->actingAsDpa();

        $student = Student::factory()->create(['dpa_id' => $dpa->id]);

        $response = $client->get(route('daftar_mahasiswa', [
            'student_id' => $student->id,
            'status' => 'Aktif',
            'lbs_id' => '',
            'year' => '2024',
            'semester' => 'GASAL'
        ]));

        $response->assertStatus(200);

        $this->assertDatabaseHas('bimbingan_study', [
            'students_id' => $student->id,
            'status' => 'Aktif',
            'semester' => 'GASAL',
            'year' => '2024',
        ]);
    }
    
     /** @test */
     public function it_can_export_bimbingan_studi_report()
     {
         [$client, $dpa] = $this->actingAsDpa();
 
         $student = Student::factory()->create([
             'dpa_id' => $dpa->id,
             'force' => 2021,
         ]);
 
         BimbinganStudy::factory()->create([
             'students_id' => $student->id,
             'year' => 2024,
             'semester' => 'GENAP',
             'status' => 'Aktif',
         ]);
 
         $response = $client->get(route('daftar_mahasiswa.export', [
             'dpa_id' => $dpa->id,
             'year' => 2024,
             'semester' => 'GENAP'
         ]));
 
         $response->assertStatus(200);
         $response->assertViewIs('report.printformat.daftarmahasiswa');
         $response->assertViewHasAll(['data', 'tahunAjaran', 'dpa', 'title', 'today']);
     }
}
