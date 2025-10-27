<?php

namespace Tests\Feature\Controllers;

use App\Models\Student;
use App\Models\Ukt;
use App\Models\Faculty;
use App\Models\StudyProgram;
use App\Models\BimbinganStudy;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UktDetailControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }

    /** @test */
    public function student_filter_without_id_should_use_default()
    {
        $this->actingAsAdmin();
        $student = Student::factory()->create();
        $ukt = Ukt::factory()->create(['students_id' => $student->id]);

        $response = $this->get('/uktdetail?filterUkt=student');

        $response->assertStatus(200);
        $response->assertViewHas('ukt');
        $response->assertSee((string) $ukt->id);
    }

    /** @test */
    public function student_filter_with_invalid_id_should_return_empty_ukt()
    {
        $this->actingAsAdmin();
        $response = $this->get('/uktdetail?filterUkt=student&students_id=999');

        $response->assertStatus(200);
        $response->assertViewHas('ukt', null);
        $response->assertViewHas('totalUkt', 0);
    }

    /** @test */
    public function process_dispensasi_should_update_payment_for_uts()
    {
        $this->actingAsAdmin();
        $student = Student::factory()->create();
        $ukt = Ukt::factory()->create(['students_id' => $student->id, 'year' => 2024, 'semester' => 'GASAL']);
        BimbinganStudy::factory()->create([
            'students_id' => $student->id,
            'year' => $ukt->year,
            'semester' => $ukt->semester,
            'status' => 'Aktif'
        ]);

        $response = $this->get('/uktdetail?filterUkt=student&students_id=' . $student->id . '&id=' . $ukt->id . '&dispensasi=Menunggu Dispensasi UTS');

        $response->assertStatus(200);
        $this->assertEquals('Dispen UTS', $ukt->fresh()->keterangan);
        $this->assertNotNull($ukt->fresh()->exam_uts_id);
    }

    /** @test */
    public function faculty_filter_with_valid_data_should_return_ukt()
    {
        $this->actingAsAdmin();
        $faculty = Faculty::factory()->create();
        $program = StudyProgram::factory()->create(['faculty_id' => $faculty->id]);
        $student = Student::factory()->create(['study_program_id' => $program->id]);
        $ukt = Ukt::factory()->create(['students_id' => $student->id]);

        $response = $this->get('/uktdetail?filterUkt=faculty&faculty_id=' . $faculty->id . '&datepicker=' . now()->format('m-Y'));

        $response->assertStatus(200);
        $response->assertViewHas('ukt');
        $response->assertSee((string) $ukt->id);
    }

    /** @test */
    public function faculty_filter_with_invalid_faculty_should_return_empty()
    {
        $this->actingAsAdmin();
        $response = $this->get('/uktdetail?filterUkt=faculty&faculty_id=999&datepicker=' . now()->format('m-Y'));

        $response->assertStatus(200);
        $response->assertViewHas('ukt', null);
        $response->assertViewHas('totalUkt', 0);
    }

    /** @test */
    public function get_date_with_empty_input_should_return_current_month()
    {
        $this->actingAsAdmin();
        $controller = new \App\Http\Controllers\Report\UktDetailController();
        $result = $controller->getDate(null);

        $this->assertEquals(date('Y-m'), $result[0]);
        $this->assertEquals(date('F Y'), $result[1]);
    }

    /** @test */
    public function get_date_with_valid_input_should_return_parsed_date()
    {
        $this->actingAsAdmin();
        $controller = new \App\Http\Controllers\Report\UktDetailController();
        $result = $controller->getDate('05-2024');

        $this->assertEquals('2024-05', $result[0]);
        $this->assertEquals('May 2024', $result[1]);
    }

    /** @test */
    public function export_student()
    {
        $this->actingAsAdmin();

        $student = Student::factory()->create();
        Ukt::factory()->create(['students_id' => $student->id]);

        $response = $this->get(route('uktdetail.export', [
            'filter' => 'student',
            'student' => $student->id,
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.pembayaran');
        $response->assertViewHas('totalUkt');
    }

    /** @test */
    public function export_faculty()
    {
        $this->actingAsAdmin();

        $faculty = Faculty::factory()->create();
        $studyProgram = StudyProgram::factory()->create([
            'faculty_id' => $faculty->id
        ]);

        $student = Student::factory()->create([
            'study_program_id' => $studyProgram->id
        ]);

        Ukt::factory()->create(['students_id' => $student->id]);

        $response = $this->get(route('uktdetail.export', [
            'filter' => 'faculty',
            'faculty' => $faculty->id,
            'datepicker' => now()->format('F Y'),
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.pembayaranfaculty');
        $response->assertViewHas('totalUkt');
    }

}
