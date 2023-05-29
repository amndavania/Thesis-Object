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

        User::factory(5)->create();
        AccountingGroup::factory(30)->create();
        TransactionAccount::factory(30)->create();
        Transaction::factory(100)->create();
        StudentType::factory(30)->create();
        Report::factory(30)->create();
        Faculty::factory(30)->create();
        StudyProgram::factory(30)->create();
        Student::factory(250)->create();
        Ukt::factory(40)->create();
    }
}
