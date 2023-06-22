<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AccountingGroup;
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

        AccountingGroup::factory()->create(['name'=> 'Pendapatan','description' => 'grup akun pendapatan']);
        AccountingGroup::factory()->create(['name'=> 'Pengeluaran','description' => 'grup akun pengeluaran']);
        AccountingGroup::factory()->create(['name'=> 'Penyusutan/Amortisasi','description' => 'grup akun penyusutan/amortisasi']);      
        AccountingGroup::factory()->create(['name'=> 'Bunga/Pajak','description' => 'grup akun bunga/pajak']);
        AccountingGroup::factory()->create(['name'=> 'Pendapatan atau Pengeluaran lain','description' => 'grup akun pendapatan atau pengeluaran lain2']);
        AccountingGroup::factory()->create(['name'=> 'Aktiva Lancar','description' => 'grup akun aktiva lancar']);
        AccountingGroup::factory()->create(['name'=> 'Aktiva Tetap','description' => 'grup akun aktiva tetap']);
        AccountingGroup::factory()->create(['name'=> 'Hutang Lancar','description' => 'grup akun hutang lancar']);
        AccountingGroup::factory()->create(['name'=> 'Utang Jangka Panjang','description' => 'grup akun utang jangka panjang']);        
        AccountingGroup::factory()->create(['name'=> 'Modal','description' => 'grup akun modal']);
        AccountingGroup::factory()->create(['name'=> 'Arus Kas Masuk','description' => 'grup akun kas masuk']);
        AccountingGroup::factory()->create(['name'=> 'Arus Kas Keluar','description' => 'grup akun kas keluar']);
        AccountingGroup::factory()->create(['name'=> 'Penjualan Aset','description' => 'grup akun penjualan aset']);
        AccountingGroup::factory()->create(['name'=> 'Pembelian Aset','description' => 'grup akun pembelian aset']);
        AccountingGroup::factory()->create(['name'=> 'Penambahan Dana','description' => 'grup akun penambahan dana']);
        AccountingGroup::factory()->create(['name'=> 'Pengurangan Dana','description' => 'grup akun pengurangan dana']);
        AccountingGroup::factory()->create(['name'=> 'Modal di Awal','description' => 'grup akun modal di awal']);
        AccountingGroup::factory()->create(['name'=> 'Penambahan Modal','description' => 'grup akun penambahan modal']);
        AccountingGroup::factory()->create(['name'=> 'Pengurangan Modal','description' => 'grup akun pengurangan modal']);
        AccountingGroup::factory()->create(['name'=> 'Bank','description' => 'grup akun bank']);
        
        TransactionAccount::factory()->create([
            'id' => 1120,
            'name'=> 'Kas Operasional',
            'description' => 'pendapatan',
            'ammount_kredit' => 0,
            'ammount_debit' => 0,
            'accounting_group_id' => 6,
        ]);
        TransactionAccount::factory()->create([
            'id' => 1130,
            'name'=> 'Bank BRI Ibrahimy',
            'description' => 'bank',
            'ammount_kredit' => 0,
            'ammount_debit' => 0,
            'accounting_group_id' => 6,
        ]);



        // User::factory(7)->create();
        // AccountingGroup::factory(10)->create();
        // TransactionAccount::factory(28)->create();
        // Transaction::factory(100)->create();
        // StudentType::factory(30)->create();
        // Report::factory(30)->create();
        // Faculty::factory(30)->create();
        // StudyProgram::factory(30)->create();
        // Student::factory(250)->create();
        // Ukt::factory(40)->create();
    }
}
