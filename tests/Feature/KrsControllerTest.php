<?php

namespace Tests\Feature;

use App\Models\BimbinganStudy;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KrsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        $this->actingAs($user);
        return $user;
    }

    /** @test */
    public function it_can_export_krs_report()
    {
        $this->actingAsAdmin();

        // Buat student
        $student = Student::factory()->create([
            'name'   => 'Andi',
            'nim'    => '87654321',
            'force'  => 2022, // angkatan
        ]);

        // Buat bimbingan study
        $bimbingan = BimbinganStudy::factory()->create([
            'students_id' => $student->id,
            'year'        => 2024,
            'semester'    => 'GENAP',
        ]);

        // Request ke route export (pastikan route sudah ada)
        $response = $this->get(route('krs.export', [
            'id' => $bimbingan->id,
        ]));

        // Assertion
        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.krs');
        $response->assertViewHasAll([
            'bimbinganstudi',
            'student',
            'semester',
            'title',
            'today',
        ]);
        $response->assertViewHas('student', function ($viewStudent) use ($student) {
            return $viewStudent->id === $student->id;
        });
    }
}
