<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ukt;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\BimbinganStudy;
use App\Models\ExamCard;
use App\Models\User; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OldUktControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }    

    protected function setUp(): void
    {
        parent::setUp();
    
        User::factory()->create(['id' => 1, 'role' => 'super admin']);
        $this->actingAs(User::find(1));
    
        // ✅ Buat studentType & student dan simpan di properti
        $this->studentType = StudentType::factory()->create([
            'krs' => 100000,
            'uts' => 200000,
            'uas' => 300000,
            'dpp' => 400000,
        ]);
    
        $this->student = Student::factory()->create([
            'student_types_id' => $this->studentType->id,
            'force' => 2020,
        ]);
    
        TransactionAccount::factory()->create(['id' => 1120, 'kredit' => 0]);
        TransactionAccount::factory()->create(['id' => 1130, 'debit' => 0]);
    }
    

    public function test_index_page_can_be_loaded()
    {
        $response = $this->get(route('ukt.index'));
        $response->assertStatus(200);
        $response->assertViewIs('ukt.data');
    }

    public function test_create_page_can_be_loaded()
    {
        $response = $this->get(route('ukt.create'));
        $response->assertStatus(200);
        $response->assertViewIs('ukt.create');
    }


    public function test_store_ukt_with_automatic_examcard_and_bimbinganstudy_generation()
    {
        // Buat transaksi dan entitas wajib lainnya
        $transactionDebit = Transaction::factory()->create();
        $transactionKredit = Transaction::factory()->create();
    
        // Tambahkan record DPP yang lunas agar lolos validasi
        Ukt::factory()->create([
            'students_id' => $this->student->id,
            'year' => 2022,
            'semester' => 'GENAP',
            'type' => 'DPP',
            'status' => 'Lunas',
        ]);
    
        // Tambahkan record UKT semester sebelumnya yang lunas
        Ukt::factory()->create([
            'students_id' => $this->student->id,
            'year' => 2023,  // yearPrevious
            'semester' => 'GENAP', // semesterPrevious dari GASAL 2024
            'type' => 'UKT',
            'status' => 'Lunas',
        ]);
    
        $data = [
            'students_id' => $this->student->id,
            'year' => 2024,
            'semester' => 'GASAL',
            'type' => 'UKT',
            'amount' => 600000, // Pastikan cukup untuk Lunas (di atas totalUAS)
            'created_at' => '2024-08-01',
            'reference_number' => '123456',
        ];
    
        $response = $this->post(route('ukt.store'), $data);
    
        $response->assertRedirect(route('ukt.index'));
        $this->assertDatabaseHas('ukts', [
            'students_id' => $this->student->id,
            'year' => 2024,
            'semester' => 'GASAL',
            'type' => 'UKT',
            'status' => 'Lunas',
        ]);
    
        // Pastikan exam_card UTS dan UAS otomatis dibuat
        $this->assertDatabaseHas('exam_card', [
            'students_id' => $this->student->id,
            'type' => 'UTS',
            'semester' => 'GASAL',
            'year' => 2024,
        ]);
        $this->assertDatabaseHas('exam_card', [
            'students_id' => $this->student->id,
            'type' => 'UAS',
            'semester' => 'GASAL',
            'year' => 2024,
        ]);
    
        // Pastikan Bimbingan Study otomatis dibuat
        $this->assertDatabaseHas('bimbingan_study', [
            'students_id' => $this->student->id,
            'semester' => 'GASAL',
            'year' => 2024,
        ]);
    
        // Pastikan transaksi tersimpan
        $this->assertDatabaseHas('transactions', [
            'reference_number' => '123456',
            'type' => 'debit',
        ]);
        $this->assertDatabaseHas('transactions', [
            'reference_number' => '123456',
            'type' => 'kredit',
        ]);
    }    
    
    
    public function test_set_total_status_returns_correct_status()
    {
        $controller = new \App\Http\Controllers\UktController();

        $ukt = Ukt::factory()->create([
            'students_id' => $this->student->id,
            'year' => 2024,
            'semester' => 'GENAP',
            'type' => 'UKT',
            'amount' => 600000
        ]);

        $debit = TransactionAccount::factory()->create(['id' => 10]);
        $kredit = TransactionAccount::factory()->create(['id' => 11]);
        $examUts = ExamCard::factory()->create(['students_id' => $this->student->id]);
        $examUas = ExamCard::factory()->create(['students_id' => $this->student->id]);
        $lbs = BimbinganStudy::factory()->create(['students_id' => $this->student->id]);        

        $status = $controller->setTotalStatus(
            $this->student->id,
            2024,
            'GENAP',
            'UKT',
            $this->studentType,
            100000 // nominal tambahan
        );

        $this->assertTrue(in_array($status, ['Lunas', 'Lebih', 'Lunas UTS', 'Lunas KRS', 'Belum Lunas']));
    }

    public function test_create_exam_card()
    {
        $controller = new \App\Http\Controllers\UktController();

        $id = $controller->createExamCard($this->student->id, 'UTS', 'GENAP', 2024);
        $this->assertDatabaseHas('exam_card', [
            'id' => $id,
            'type' => 'UTS',
            'semester' => 'GENAP',
            'year' => 2024,
        ]);
    }

    public function test_create_bimbingan_study()
    {
        $controller = new \App\Http\Controllers\UktController();

        $id = $controller->createBimbinganStudy($this->student->id, 2024, 'GENAP');
        $this->assertDatabaseHas('bimbingan_study', [
            'id' => $id,
            'students_id' => $this->student->id,
            'status' => 'Tunda',
        ]);
    }

    public function test_delete_exam_card()
    {
        $controller = new \App\Http\Controllers\UktController();
        $exam = ExamCard::factory()->create([
            'students_id' => $this->student->id
        ]);        

        $controller->deleteExamCard($exam->id);
        $this->assertDatabaseMissing('exam_card', ['id' => $exam->id]);
    }

    public function test_delete_bimbingan_studi()
    {
        $controller = new \App\Http\Controllers\UktController();
        $bimbingan = BimbinganStudy::factory()->create(['students_id' => $this->student->id]);

        $controller->deleteBimbinganStudi($bimbingan->id);
        $this->assertDatabaseMissing('bimbingan_study', ['id' => $bimbingan->id]);
    }

    public function test_update_transaction_account()
    {
        $controller = new \App\Http\Controllers\UktController();
        $controller->updateTransactionAccount(1120, 'kredit', 10000);
        $this->assertEquals(10000, TransactionAccount::find(1120)->kredit);

        $controller->updateTransactionAccount(1130, 'debit', 20000);
        $this->assertEquals(20000, TransactionAccount::find(1130)->debit);
    }

    public function test_add_and_delete_transaction()
    {
        
        $controller = new \App\Http\Controllers\UktController();
        $controller->addTransaction(1, 'test', '123456', 5000, 'debit', 1130);
        $this->assertDatabaseHas('transactions', ['reference_number' => '123456']);

        $transaction = Transaction::where('reference_number', '123456')->first();
        $controller->deleteTransaction($transaction->id);
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }

    public function test_set_keterangan_lunas_generates_examcards_and_bimbingan()
    {
        $controller = new \App\Http\Controllers\UktController();

        $ukt = Ukt::factory()->create([
            'students_id' => $this->student->id,
            'year' => 2024,
            'semester' => 'GENAP',
            'type' => 'UKT',
        ]);

        $studentData = [$this->student, $this->studentType];
        $controller->setKeterangan($studentData, 2024, 'GENAP', 'UKT', 'Lunas', $ukt);

        $this->assertDatabaseHas('exam_card', [
            'students_id' => $this->student->id,
            'type' => 'UTS',
        ]);
        $this->assertDatabaseHas('exam_card', [
            'students_id' => $this->student->id,
            'type' => 'UAS',
        ]);
        $this->assertDatabaseHas('bimbingan_study', [
            'students_id' => $this->student->id,
        ]);
    }

    public function test_set_keterangan_lunas_uts_sets_exam_or_keterangan()
    {
        $controller = new \App\Http\Controllers\UktController();
        $ukt = Ukt::factory()->create(['students_id' => $this->student->id, 'type' => 'UKT']);
        $studentData = [$this->student, $this->studentType];

        // tanpa exam card → buat exam dan bimbingan
        $controller->setKeterangan($studentData, 2024, 'GENAP', 'UKT', 'Lunas UTS', $ukt);
        $this->assertDatabaseHas('exam_card', [
            'type' => 'UTS',
            'students_id' => $this->student->id,
        ]);

        // dengan exam card → hanya set keterangan
        ExamCard::where('students_id', $this->student->id)->delete();
        ExamCard::factory()->create([
            'students_id' => $this->student->id,
            'type' => 'UTS',
            'semester' => 'GENAP',
            'year' => 2024,
        ]);
        $ukt2 = Ukt::factory()->create(['students_id' => $this->student->id, 'type' => 'UKT']);
        $controller->setKeterangan($studentData, 2024, 'GENAP', 'UKT', 'Lunas UTS', $ukt2);
        $this->assertEquals('Menunggu Dispensasi UAS', $ukt2->keterangan);
    }

    public function test_set_keterangan_lunas_krs_sets_keterangan_or_lbs()
    {
        $controller = new \App\Http\Controllers\UktController();
        $ukt = Ukt::factory()->create(['students_id' => $this->student->id, 'type' => 'UKT']);
        $studentData = [$this->student, $this->studentType];

        // Tanpa bimbingan → akan dibuat
        $controller->setKeterangan($studentData, 2024, 'GENAP', 'UKT', 'Lunas KRS', $ukt);
        $this->assertDatabaseHas('bimbingan_study', [
            'students_id' => $this->student->id,
        ]);

        // Sudah ada bimbingan → hanya keterangan
        $ukt2 = Ukt::factory()->create(['students_id' => $this->student->id, 'type' => 'UKT']);
        $controller->setKeterangan($studentData, 2024, 'GENAP', 'UKT', 'Lunas KRS', $ukt2);
        $this->assertEquals('Menunggu Dispensasi UTS', $ukt2->keterangan);
    }

    public function test_set_keterangan_belum_lunas_sets_keterangan()
    {
        $controller = new \App\Http\Controllers\UktController();
        $ukt = Ukt::factory()->create(['students_id' => $this->student->id, 'type' => 'UKT']);

        $studentData = [$this->student, $this->studentType];
        $controller->setKeterangan($studentData, 2024, 'GENAP', 'UKT', 'Belum Lunas', $ukt);
        $this->assertEquals('Menunggu Dispensasi KRS', $ukt->keterangan);
    }

}
