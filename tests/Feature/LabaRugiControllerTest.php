<?php

namespace Tests\Feature\Report;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabaRugiControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        $this->actingAs($user);
        return $user;
    }

    public function setUp(): void
    {
        parent::setUp();

        // account dummy
        $this->account = TransactionAccount::factory()->create([
            'name' => 'Pendapatan',
            'lajurLaporan' => 'labaRugi',
        ]);

        // transaction dummy (debit & kredit)
        Transaction::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'type' => 'debit',
            'amount' => 1000,
            'created_at' => now(),
        ]);
        Transaction::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'type' => 'kredit',
            'amount' => 500,
            'created_at' => now(),
        ]);

        // history dummy
        HistoryReport::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'saldo' => 200,
            'type' => 'monthly',
            'created_at' => now(),
        ]);
    }

    public function test_index_returns_expected_view_and_data()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('labarugi.index', [
            'datepicker' => now()->format('m-Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.labarugi');

        $response->assertViewHasAll([
            'pendapatan', 'pengeluaran', 'penyusutanAmortisasi',
            'bungaPajak', 'pendapatanPengeluaranLain',
            'datepicker', 'filter',
        ]);
    }

    public function test_export_returns_expected_view_and_data()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('labarugi.export', [
            'datepicker' => now()->format('F Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.labarugi');

        $response->assertViewHasAll([
            'pendapatan', 'pengeluaran', 'penyusutanAmortisasi',
            'bungaPajak', 'pendapatanPengeluaranLain',
            'datepicker', 'today', 'title',
        ]);
        $response->assertViewHas('title', 'Laporan Neraca');
    }
}
