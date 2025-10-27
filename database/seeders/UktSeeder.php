<?php

namespace Database\Seeders;

use App\Models\Ukt;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\ExamCard;
use App\Models\BimbinganStudy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class UktSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil satu data yang valid untuk foreign key
        $student = Student::first();
        $transactionDebit = Transaction::factory()->create();
        $transactionKredit = Transaction::factory()->create();
        $examUts = ExamCard::factory()->create(['students_id' => $student->id]);
        $examUas = ExamCard::factory()->create(['students_id' => $student->id]);
        $lbs = BimbinganStudy::factory()->create(['students_id' => $student->id]);

        // Buat satu data UKT
        Ukt::create([
            'students_id' => $student->id,
            'year' => '2023',
            'semester' => 'GASAL',
            'type' => 'UKT',
            'reference_number' => 'REF12345',
            'amount' => 600000.00,
            'status' => 'Lunas',
            'keterangan' => 'Pembayaran semester Ganjil',
            'transaction_debit_id' => $transactionDebit->id,
            'transaction_kredit_id' => $transactionKredit->id,
            'lbs_id' => $lbs->id,
            'exam_uts_id' => $examUts->id,
            'exam_uas_id' => $examUas->id,
            'created_at' => Carbon::parse('2023-08-01'),
            'updated_at' => now(),
        ]);
    }
}
