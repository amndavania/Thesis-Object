<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AccountingGroup;
use App\Models\Balance;
use App\Models\Faculty;
use App\Models\Report;
use App\Models\Student;
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
            'email' => 'admin@admin.com',
            'password'  => bcrypt('admin'),
        ]);

        AccountingGroup::factory(10)->create();
        TransactionAccount::factory(10)->create();
        Balance::factory(10)->create();
        Faculty::factory(10)->create();
// 
    }
}
