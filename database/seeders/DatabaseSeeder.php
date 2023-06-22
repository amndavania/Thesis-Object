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

        AccountingGroup::factory()->create(['name'=> 'grup akun pendapatan','description' => 'grup akun pendapatan']);
        AccountingGroup::factory()->create(['name'=> 'grup akun pengeluaran','description' => 'grup akun pengeluaran']);
        AccountingGroup::factory()->create(['name'=> 'grup akun penyusutan/amortisasi','description' => 'grup akun penyusutan/amortisasi']);      
        AccountingGroup::factory()->create(['name'=> 'grup akun bunga/pajak','description' => 'grup akun bunga/pajak']);
        AccountingGroup::factory()->create(['name'=> 'grup akun pendapatan atau pengeluaran lain2','description' => 'grup akun pendapatan atau pengeluaran lain2']);
        AccountingGroup::factory()->create(['name'=> 'grup akun aktiva lancar','description' => 'grup akun aktiva lancar']);
        AccountingGroup::factory()->create(['name'=> 'grup akun aktiva tetap','description' => 'grup akun aktiva tetap']);
        AccountingGroup::factory()->create(['name'=> 'grup akun hutang lancar','description' => 'grup akun hutang lancar']);
        AccountingGroup::factory()->create(['name'=> 'grup akun utang jangka panjang','description' => 'grup akun utang jangka panjang']);        
        AccountingGroup::factory()->create(['name'=> 'grup akun modal','description' => 'grup akun modal']);
        AccountingGroup::factory()->create(['name'=> 'grup akun kas masuk','description' => 'grup akun kas masuk']);
        AccountingGroup::factory()->create(['name'=> 'grup akun kas keluar','description' => 'grup akun kas keluar']);
        AccountingGroup::factory()->create(['name'=> 'grup akun penjualan aset','description' => 'grup akun penjualan aset']);
        AccountingGroup::factory()->create(['name'=> 'grup akun pembelian aset','description' => 'grup akun pembelian aset']);
        AccountingGroup::factory()->create(['name'=> 'grup akun penambahan dana','description' => 'grup akun penambahan dana']);
        AccountingGroup::factory()->create(['name'=> 'grup akun pengurangan dana','description' => 'grup akun pengurangan dana']);
        AccountingGroup::factory()->create(['name'=> 'grup akun modal di awal','description' => 'grup akun modal di awal']);
        AccountingGroup::factory()->create(['name'=> 'grup akun penambahan modal','description' => 'grup akun penambahan modal']);
        AccountingGroup::factory()->create(['name'=> 'grup akun pengurangan modal','description' => 'grup akun pengurangan modal']);
        AccountingGroup::factory()->create(['name'=> 'grup akun bank','description' => 'grup akun bank']);
        
        TransactionAccount::factory()->create([
            'name'=> 'akun transaksi pendapatan',
            'description' => 'pendapatan',
            'ammount_kredit' => 0,
            'ammount_debit' => 0,
            'accounting_group_id' => 1,
        ]);
        TransactionAccount::factory()->create([
            'name'=> 'akun transaksi bank',
            'description' => 'bank',
            'ammount_kredit' => 0,
            'ammount_debit' => 0,
            'accounting_group_id' => 20,
        ]);



        User::factory(7)->create();
        AccountingGroup::factory(10)->create();
        TransactionAccount::factory(28)->create();
        Transaction::factory(100)->create();
        Faculty::factory(30)->create();
        StudyProgram::factory(30)->create();
        StudentType::factory(30)->create();
        Student::factory(250)->create();
        Report::factory(30)->create();
        Ukt::factory(40)->create();
    }
}
