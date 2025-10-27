<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dpa;
use App\Models\User;
use App\Models\Ukt;
use App\Models\Student;
use App\Models\ExamCard;
use App\Models\BimbinganStudy;
use App\Models\StudyProgram;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

class OldDpaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }

    protected function actingAsDpa()
    {
        $user = User::factory()->create(['role' => 'DPA']);
        $dpa = Dpa::factory()->create(['user_id' => $user->id]);
        return [$this->actingAs($user), $dpa];
    }

    /** @test */
    public function it_can_load_dpa_index_page()
    {
        $this->actingAsAdmin();
        Dpa::factory()->count(3)->create();

        $response = $this->get(route('dpa.index'));
        $response->assertStatus(200);
        $response->assertViewIs('dpa.data');
        $response->assertViewHas('dpa');
    }

    /** @test */
    public function it_can_show_create_page()
    {
        $this->actingAsAdmin();
        StudyProgram::factory()->create();

        $response = $this->get(route('dpa.create'));
        $response->assertStatus(200);
        $response->assertViewIs('dpa.create');
    }

    /** @test */
    public function it_can_store_a_new_dpa()
    {
        $this->actingAsAdmin();
        $studyProgram = StudyProgram::factory()->create();

        $response = $this->post(route('dpa.store'), [
            'name' => 'DPA Test',
            'email' => 'dpa@test.com',
            'study_program_id' => $studyProgram->id,
        ]);

        $response->assertRedirect(route('dpa.index'));
        $this->assertDatabaseHas('dpas', ['email' => 'dpa@test.com']);
        $this->assertDatabaseHas('users', ['email' => 'dpa@test.com']);
    }

    /** @test */
    public function it_can_show_edit_page()
    {
        $this->actingAsAdmin();
        $dpa = Dpa::factory()->create();

        $response = $this->get(route('dpa.edit', $dpa->id));
        $response->assertStatus(200);
        $response->assertViewIs('dpa.edit');
        $response->assertViewHas('dpa');
    }

    /** @test */
    public function it_can_update_dpa_data()
    {
        $this->actingAsAdmin();
        $dpa = Dpa::factory()->create();

        $response = $this->put(route('dpa.update', $dpa->id), [
            'name' => 'Updated Name',
            'email' => 'updated@email.com',
            'study_program_id' => $dpa->study_program_id,
        ]);

        $response->assertRedirect(route('dpa.index'));
        $this->assertDatabaseHas('dpas', ['name' => 'Updated Name']);
        $this->assertDatabaseHas('users', ['email' => 'updated@email.com']);
    }

    /** @test */
    public function it_can_delete_dpa_if_not_connected_to_student()
    {
        $this->actingAsAdmin();
        $dpa = Dpa::factory()->create();

        $response = $this->delete(route('dpa.destroy', $dpa->id));

        $response->assertViewIs('dpa.data');
        $this->assertDatabaseMissing('dpas', ['id' => $dpa->id]);
        $this->assertDatabaseMissing('users', ['id' => $dpa->user_id]);
    }

    /** @test */
    public function it_cannot_delete_dpa_if_has_students()
    {
        $this->actingAsAdmin();
        $dpa = Dpa::factory()->create();
        Student::factory()->create(['dpa_id' => $dpa->id]);

        $response = $this->delete(route('dpa.destroy', $dpa->id));

        $response->assertRedirect(route('dpa.index'));
        $response->assertSessionHas('warning');
        $this->assertDatabaseHas('dpas', ['id' => $dpa->id]);
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
        $student = Student::factory()->create([ 'dpa_id' => $dpa->id, 'force' => 2021 ]);

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

    public function setUp(): void
    {
        parent::setUp();

        Route::put('/dpa/{id}/activate', [\App\Http\Controllers\DpaController::class, 'getDetailDpa'])->name('dpa.getDetailDpa');
    }
}
