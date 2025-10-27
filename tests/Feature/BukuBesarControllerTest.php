<?php

namespace Tests\Feature\Report;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BukuBesarControllerTest extends TestCase
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

        // siapkan account dummy
        $this->account = TransactionAccount::factory()->create([
            'name' => 'Kas',
            'lajurLaporan' => 'neraca',
        ]);

        // siapkan transaction dummy
        Transaction::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'created_at' => now(),
        ]);

        // siapkan history dummy
        HistoryReport::factory()->create([
            'transaction_accounts_id' => $this->account->id,
            'type' => 'monthly',
            'created_at' => now(),
        ]);
    }

    public function test_index_returns_same_view_and_data()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('bukubesar.index', [
            'search_account' => $this->account->id,
            'datepicker' => now()->format('m-Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.bukubesar');
        $response->assertViewHasAll([
            'data', 'selects', 'account', 'datepicker',
            'filter', 'history', 'lajurLaporan',
        ]);
    }

    public function test_export_returns_same_view_and_data()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('bukubesar.export', [
            'search_account' => $this->account->id,
            'datepicker' => now()->format('F Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.bukubesar');
        $response->assertViewHasAll([
            'data', 'datepicker', 'today',
            'account', 'title', 'history', 'lajurLaporan',
        ]);
        $response->assertViewHas('title', 'Laporan Buku Besar');
    }
}
