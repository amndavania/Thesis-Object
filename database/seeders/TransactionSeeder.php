<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user dulu (id 1-3)
        User::factory()->count(3)->create();

        // Pastikan ada TransactionAccount dulu (id 1-58)
        TransactionAccount::factory()->count(58)->create();

        // Buat transaksi
        Transaction::factory()->count(50)->create();
    }
}
