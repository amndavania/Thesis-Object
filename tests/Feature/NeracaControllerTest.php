<?php

namespace Tests\Feature\Report;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NeracaControllerTest extends TestCase
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

        // buat account dummy
        $this->account = TransactionAccount::factory()->create([
            'name' => 'Aktiva Lancar',
            'lajurSaldo' => 'debit',
            'lajurLaporan' => 'neraca',
        ]);

        // buat transaksi dummy
        Transaction::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'type' => 'debit',
            'amount' => 1000,
            'created_at' => now(),
        ]);

        // buat history dummy
        HistoryReport::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'type' => 'monthly',
            'saldo' => 500,
            'created_at' => now(),
        ]);
    }

    public function test_index_returns_expected_view_and_data()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('neraca.index', [
            'datepicker' => now()->format('m-Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.neraca');
        $response->assertViewHasAll([
            'aktivaLancar',
            'aktivaTetap',
            'hutangLancar',
            'hutangJangkaPanjang',
            'modal',
            'datepicker',
            'filter',
        ]);
    }

    public function test_export_returns_expected_view_and_data()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('neraca.export', [
            'datepicker' => now()->format('F Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.neraca');
        $response->assertViewHasAll([
            'aktivaLancar',
            'aktivaTetap',
            'hutangLancar',
            'hutangJangkaPanjang',
            'modal',
            'datepicker',
            'today',
            'title',
        ]);
        $response->assertViewHas('title', 'Laporan Neraca');
    }
}
