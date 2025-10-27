<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AccountingGroup;
use App\Models\Dpa;
use App\Models\Faculty;
use App\Models\Report;
use App\Models\Student;
use App\Models\StudentType;
use App\Models\StudyProgram;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;

// use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        fake()->unique($reset = true);

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('admin'),
                'role' => 'super admin',
            ]
        );
        

        $accountingGroups = [
            // laba rugi
            ['name' => 'Pendapatan', 'description' => 'grup akun pendapatan'],
            ['name' => 'Pengeluaran', 'description' => 'grup akun pengeluaran'],
            ['name' => 'Penyusutan/Amortisasi', 'description' => 'grup akun penyusutan/amortisasi'],
            ['name' => 'Bunga/Pajak', 'description' => 'grup akun bunga/pajak'],
            ['name' => 'Pendapatan atau Pengeluaran lain', 'description' => 'grup akun pendapatan atau pengeluaran lain2'],
            // neraca
            ['name' => 'Aktiva Lancar', 'description' => 'grup akun aktiva lancar'],
            ['name' => 'Aktiva Tetap', 'description' => 'grup akun aktiva tetap'],
            ['name' => 'Hutang Lancar', 'description' => 'grup akun hutang lancar'],
            ['name' => 'Utang Jangka Panjang', 'description' => 'grup akun utang jangka panjang'],
            ['name' => 'Modal', 'description' => 'grup akun modal'],
            // cashflow
            ['name' => 'Arus Kas', 'description' => 'grup akun kas masuk dan keluar'],
            ['name' => 'Aset', 'description' => 'grup akun pembelian dan penjualan aset'],
            ['name' => 'Penambahan Dana', 'description' => 'grup akun penambahan dana'],
            ['name' => 'Pengurangan Dana', 'description' => 'grup akun pengurangan dana'],
            // perubahan modal
            ['name' => 'Modal', 'description' => 'grup akun modal di awal dan penambahan modal'],
            ['name' => 'Pengurangan Modal', 'description' => 'grup akun pengurangan modal'],
        ];

        // $transactionAccounts = TransactionAccount::factory()->count(58)->create();

        $this->call([
            TransactionAccountSeeder::class,
        ]);        
    

        // $groupTransactions = collect($accountingGroups)->map(function ($group) {
        //     return AccountingGroup::factory()->create($group);
        // });
        foreach ($accountingGroups as $group) {
            AccountingGroup::factory()->create($group);
        }

        $groupTransactionsPivot = [
            [
                'group_id' => 1,
                'transaction_accounts' => [1120],
            ],
            [
                'group_id' => 11,
                'transaction_accounts' => [1120],
            ],
            [
                'group_id' => 6,
                'transaction_accounts' => [1130],
            ],
        ];

        foreach ($groupTransactionsPivot as $groupTransaction) {
            $group = AccountingGroup::find($groupTransaction['group_id']);
            $transactionAccounts = TransactionAccount::find($groupTransaction['transaction_accounts']);

            $group->transactionAccounts()->attach(
                $transactionAccounts->pluck('id')->toArray()
            );
        }
        
        $this->call([
            StudentSeeder::class,
            TransactionSeeder::class,
            ExamCardSeeder::class,
            BimbinganStudySeeder::class,
            UktSeeder::class, // terakhir, karena tergantung data lainnya
        ]);
        


        // foreach ($groupTransactions as $groupTransaction) {
        //     $randomTransactionAccounts = $transactionAccounts->random(3);

        //     $groupTransaction->transactionAccounts()->attach(
        //         $randomTransactionAccounts->pluck('id')->toArray()
        //     );
        // }


        // Transaction::factory(1000)->create();
        // Faculty::factory(5)->create();
        // StudyProgram::factory(13)->create();
        // StudentType::factory(5)->create();

        // // DPA
        // User::factory(44)->create();
        // Dpa::factory(40)->create();

        // Report::factory(30)->create();

        // Student::factory()->create([
        //     'name' => 'Ahmad Izaz Nur Fikri',
        //     'nim'=> 192410102020,
        //     'force'=> 2019,
        //     'study_program_id'=>1,
        //     'student_types_id'=>1,
        //     'dpa_id'=>1,
        // ]);

        // Student::factory(1999)->create();
        // Ukt::factory(12000)->create();
    }
}
