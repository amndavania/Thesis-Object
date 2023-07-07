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
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password'  => bcrypt('admin'),
            'role' => 'super admin'
        ]);

        User::factory()->create([
            'name' => 'admin keuangan',
            'email' => 'adminkeuangan@example.com',
            'password'  => bcrypt('admin'),
            'role' => 'admin keuangan'
        ]);
        User::factory()->create([
            'name' => 'zidny',
            'email' => 'azzidti34@gmail.com',
            'password'  => bcrypt('admin'),
            'role' => 'super admin'
        ]);

        // AccountingGroup::factory()->create(['name'=> 'Pendapatan','description' => 'grup akun pendapatan']);
        // AccountingGroup::factory()->create(['name'=> 'Pengeluaran','description' => 'grup akun pengeluaran']);
        // AccountingGroup::factory()->create(['name'=> 'Penyusutan/Amortisasi','description' => 'grup akun penyusutan/amortisasi']);      
        // AccountingGroup::factory()->create(['name'=> 'Bunga/Pajak','description' => 'grup akun bunga/pajak']);
        // AccountingGroup::factory()->create(['name'=> 'Pendapatan atau Pengeluaran lain','description' => 'grup akun pendapatan atau pengeluaran lain2']);
        // AccountingGroup::factory()->create(['name'=> 'Aktiva Lancar','description' => 'grup akun aktiva lancar']);
        // AccountingGroup::factory()->create(['name'=> 'Aktiva Tetap','description' => 'grup akun aktiva tetap']);
        // AccountingGroup::factory()->create(['name'=> 'Hutang Lancar','description' => 'grup akun hutang lancar']);
        // AccountingGroup::factory()->create(['name'=> 'Utang Jangka Panjang','description' => 'grup akun utang jangka panjang']);        
        // AccountingGroup::factory()->create(['name'=> 'Modal','description' => 'grup akun modal']);
        // AccountingGroup::factory()->create(['name'=> 'Arus Kas Masuk','description' => 'grup akun kas masuk']);
        // AccountingGroup::factory()->create(['name'=> 'Arus Kas Keluar','description' => 'grup akun kas keluar']);
        // AccountingGroup::factory()->create(['name'=> 'Penjualan Aset','description' => 'grup akun penjualan aset']);
        // AccountingGroup::factory()->create(['name'=> 'Pembelian Aset','description' => 'grup akun pembelian aset']);
        // AccountingGroup::factory()->create(['name'=> 'Penambahan Dana','description' => 'grup akun penambahan dana']);
        // AccountingGroup::factory()->create(['name'=> 'Pengurangan Dana','description' => 'grup akun pengurangan dana']);
        // AccountingGroup::factory()->create(['name'=> 'Modal di Awal','description' => 'grup akun modal di awal']);
        // AccountingGroup::factory()->create(['name'=> 'Penambahan Modal','description' => 'grup akun penambahan modal']);
        // AccountingGroup::factory()->create(['name'=> 'Pengurangan Modal','description' => 'grup akun pengurangan modal']);
        // AccountingGroup::factory()->create(['name'=> 'Bank','description' => 'grup akun bank']);
        
        $accountingGroups = [
            ['name' => 'Pendapatan', 'description' => 'grup akun pendapatan'],
            ['name' => 'Pengeluaran', 'description' => 'grup akun pengeluaran'],
            ['name' => 'Penyusutan/Amortisasi', 'description' => 'grup akun penyusutan/amortisasi'],
            ['name' => 'Bunga/Pajak', 'description' => 'grup akun bunga/pajak'],
            ['name' => 'Pendapatan atau Pengeluaran lain', 'description' => 'grup akun pendapatan atau pengeluaran lain2'],
            ['name' => 'Aktiva Lancar', 'description' => 'grup akun aktiva lancar'],
            ['name' => 'Aktiva Tetap', 'description' => 'grup akun aktiva tetap'],
            ['name' => 'Hutang Lancar', 'description' => 'grup akun hutang lancar'],
            ['name' => 'Utang Jangka Panjang', 'description' => 'grup akun utang jangka panjang'],
            ['name' => 'Modal', 'description' => 'grup akun modal'],
            ['name' => 'Arus Kas Masuk', 'description' => 'grup akun kas masuk'],
            ['name' => 'Arus Kas Keluar', 'description' => 'grup akun kas keluar'],
            ['name' => 'Penjualan Aset', 'description' => 'grup akun penjualan aset'],
            ['name' => 'Pembelian Aset', 'description' => 'grup akun pembelian aset'],
            ['name' => 'Penambahan Dana', 'description' => 'grup akun penambahan dana'],
            ['name' => 'Pengurangan Dana', 'description' => 'grup akun pengurangan dana'],
            ['name' => 'Modal di Awal', 'description' => 'grup akun modal di awal'],
            ['name' => 'Penambahan Modal', 'description' => 'grup akun penambahan modal'],
            ['name' => 'Pengurangan Modal', 'description' => 'grup akun pengurangan modal'],
            ['name' => 'Bank', 'description' => 'grup akun bank'],
        ];


        // User::factory(7)->create();

        // AccountingGroup::factory(10)->create();

        $transactionAccounts = TransactionAccount::factory()->count(58)->create();

        TransactionAccount::factory()->create([
            'id' => 1120,
            'name'=> 'Kas Operasional',
            'description' => 'pendapatan',
            'balance' => -2000000,
        ]);
        TransactionAccount::factory()->create([
            'id' => 1130,
            'name'=> 'Bank BRI Ibrahimy',
            'description' => 'bank',
            'balance' => -100000000,
        ]);



        $groupTransactions = collect($accountingGroups)->map(function ($group) {
            return AccountingGroup::factory()->create($group);
        });

        foreach ($groupTransactions as $groupTransaction) {
            $randomTransactionAccounts = $transactionAccounts->random(3);
    
            $groupTransaction->transactionAccounts()->attach(
                $randomTransactionAccounts->pluck('id')->toArray()
            );
        }


        Transaction::factory(1000)->create();
        Faculty::factory(5)->create();
        StudyProgram::factory(13)->create();
        StudentType::factory(5)->create();
        
        // DPA
        User::factory(40)->create();
        Dpa::factory(40)->create();

        // Report::factory(30)->create();

        Student::factory()->create([
            'name' => 'Ahmad Izaz Nur Fikri',
            'nim'=> 192410102020,
            'force'=> 2019,
            'study_program_id'=>mt_rand(1,13),
            'student_types_id'=>mt_rand(1,5),
            'dpa_id'=>mt_rand(1,40),
        ]);

        Student::factory(1999)->create();
        Ukt::factory(12000)->create();
    }
}
