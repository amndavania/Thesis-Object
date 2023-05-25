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
        AccountingGroup::factory(10)->create();
        TransactionAccount::factory(10)->create();
        Transaction::factory(10)->create();
        StudentType::factory(10)->create();
        Report::factory(10)->create();
        Faculty::factory(10)->create();
        StudyProgram::factory(10)->create();
        Student::factory(10)->create();
        Ukt::factory(10)->create();
    }
}
