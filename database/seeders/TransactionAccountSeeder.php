<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionAccount;

class TransactionAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat 20 akun transaksi dummy
        TransactionAccount::factory()->count(20)->create();

        // Tambahkan akun-akun khusus dengan ID tetap (jika dibutuhkan sistem)
        TransactionAccount::updateOrCreate(
            ['id' => 1120],
            [
                'name'=> 'Pendapatan UKT',
                'lajurSaldo'=> 'kredit',
                'lajurLaporan'=> 'labaRugi',
                'description' => 'pendapatan',
                'kredit' => 0,
                'debit' => 0,
            ]
        );

        TransactionAccount::updateOrCreate(
            ['id' => 1130],
            [
                'name'=> 'Bank BRI Ibrahimy',
                'lajurSaldo'=> 'debit',
                'lajurLaporan'=> 'neraca',
                'description' => 'bank',
                'kredit' => 0,
                'debit' => 0,
            ]
        );

        TransactionAccount::updateOrCreate(
            ['id' => 9999],
            [
                'name'=> 'labaDitahan',
                'lajurSaldo'=> 'debit',
                'lajurLaporan'=> 'neraca',
                'description' => 'akun khusus',
                'kredit' => 0,
                'debit' => 0,
            ]
        );
    }
}
