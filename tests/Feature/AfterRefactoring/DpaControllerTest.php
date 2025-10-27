<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Dpa;
use App\Models\User;
use App\Models\Student;
use App\Models\StudyProgram;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;

class DpaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }

    /** @test */
    public function it_can_load_dpa_index_page() //Menguji apakah halaman daftar DPA (/dpa) bisa diakses oleh admin. --> Testing method index
    {
        $this->actingAsAdmin();

        Dpa::factory()->count(3)->create();

        $response = $this->get(route('dpa.index'));

        $response->assertStatus(200);
        $response->assertViewIs('dpa.data');
        $response->assertViewHas('dpa');
    }

    /** @test */
    public function it_can_show_create_page() //Cek apakah form tambah DPA (/dpa/create) bisa ditampilkan. --> testing method create
    {
        $this->actingAsAdmin();

        StudyProgram::factory()->create();

        $response = $this->get(route('dpa.create'));
        $response->assertStatus(200);
        $response->assertViewIs('dpa.create');
    }

    /** @test */
    public function it_can_store_a_new_dpa() //Simulasi menyimpan data DPA baru. --> testing method store
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
    public function it_can_show_edit_page() //Cek halaman edit DPA (/dpa/{id}/edit) muncul dan datanya benar. --> Testing method edit
    {
        $this->actingAsAdmin();

        $dpa = Dpa::factory()->create();

        $response = $this->get(route('dpa.edit', $dpa->id));
        $response->assertStatus(200);
        $response->assertViewIs('dpa.edit');
        $response->assertViewHas('dpa');
    }

    /** @test */
    public function it_can_update_dpa_data() // Cek apakah data DPA bisa diubah --> Testing method update
    {
        $this->actingAsAdmin();

        $dpa = Dpa::factory()->create();
        $user = $dpa->user;

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
    public function it_can_delete_dpa_if_not_connected_to_student() //Menghapus DPA jika tidak ada mahasiswa yang terhubung. --> Testing method destroy
    {
        $this->actingAsAdmin();

        $dpa = Dpa::factory()->create();
        $response = $this->delete(route('dpa.destroy', $dpa->id));

        $response->assertViewIs('dpa.data');
        $this->assertDatabaseMissing('dpas', ['id' => $dpa->id]);
        $this->assertDatabaseMissing('users', ['id' => $dpa->user_id]);
    }

    /** @test */
    public function it_cannot_delete_dpa_if_has_students() //Menguji bahwa DPA tidak dapat dihapus jika masih memiliki mahasiswa yang terhubung. Sistem akan melakukan redirect dan menampilkan pesan peringatan --> Testing method destroy
    {
        $this->actingAsAdmin();

        $dpa = Dpa::factory()->create();
        Student::factory()->create(['dpa_id' => $dpa->id]);

        $response = $this->delete(route('dpa.destroy', $dpa->id));

        $response->assertRedirect(route('dpa.index'));
        $response->assertSessionHas('warning');
        $this->assertDatabaseHas('dpas', ['id' => $dpa->id]);
    }

    public function setUp(): void //untuk keperluan getDetailDpa
    {
        parent::setUp();
    
        Route::put('/dpa/{id}/activate', [\App\Http\Controllers\DpaController::class, 'getDetailDpa'])->name('dpa.getDetailDpa');
    }

    /** @test */
    // public function it_can_activate_dpa() // Menguji bahwa DPA dapat diaktifkan melalui method getDetailDpa, yang akan mengubah status user menjadi 'Aktif' dan redirect ke halaman index --> Testing untuk getDetailDpa
    // {
    //     $this->actingAsAdmin();

    //     $dpa = Dpa::factory()->create();
    //     $user = $dpa->user;

    //     $response = $this->put(route('dpa.getDetailDpa', $dpa->id), []);

    //     $response->assertRedirect(route('dpa.index'));
    //     $this->assertDatabaseHas('users', ['id' => $user->id, 'status' => 'Aktif']);
    // }
}
