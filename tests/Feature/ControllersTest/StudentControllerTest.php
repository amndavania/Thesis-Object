<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Student;
use App\Models\StudyProgram;
use App\Models\StudentType;
use App\Models\Dpa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }

    /** @test */
    public function index_page_can_be_loaded()
    {
        $this->actingAsAdmin(); 
        $response = $this->get(route('student.index'));
        $response->assertStatus(200);
        $response->assertViewIs('student.data');
    }

    /** @test */
    public function create_page_can_be_loaded()
    {
        $this->actingAsAdmin(); 
        $response = $this->get(route('student.create'));
        $response->assertStatus(200);
        $response->assertViewIs('student.create');
    }

    /** @test */
    public function student_can_be_stored()
    {
        $this->actingAsAdmin(); 
        $studyProgram = StudyProgram::factory()->create();
        $studentType = StudentType::factory()->create();
        $dpa = Dpa::factory()->create();

        $data = [
            'name' => 'Test Student',
            'nim' => '123456',
            'force' => 2022,
            'study_program_id' => $studyProgram->id,
            'student_types_id' => $studentType->id,
            'dpa_id' => $dpa->id,
        ];

        $response = $this->post(route('student.store'), $data);

        $response->assertRedirect(route('student.index'));
        $this->assertDatabaseHas('students', ['nim' => '123456']);
    }

    /** @test */
    public function student_can_be_updated()
    {
        $this->actingAsAdmin(); 
        $student = Student::factory()->create();

        $response = $this->put(route('student.update', $student->id), [
            'name' => 'Updated Name',
            'nim' => $student->nim,
            'force' => $student->force,
            'study_program_id' => $student->study_program_id,
            'student_types_id' => $student->student_types_id,
            'dpa_id' => $student->dpa_id,
        ]);

        $response->assertRedirect(route('student.index'));
        $this->assertDatabaseHas('students', ['id' => $student->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function student_can_be_deleted()
    {
        $this->actingAsAdmin(); 
        $student = Student::factory()->create();

        $response = $this->delete(route('student.destroy', $student->id));

        $response->assertRedirect(route('student.index'));
        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
