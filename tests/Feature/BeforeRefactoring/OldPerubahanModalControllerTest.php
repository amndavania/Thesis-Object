<?php

namespace Tests\Feature\Report;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use App\Http\Controllers\Report\PerubahanModalController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OldPerubahanModalControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        $this->actingAs($user);
    }

    /** @test */
    public function index_returns_perubahanmodal_view()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('perubahanmodal.index'));

        $response->assertStatus(200);
        $response->assertViewIs('report.perubahanmodal');
        $response->assertViewHasAll([
            'modal',
            'penguranganModal',
            'datepicker',
            'filter',
            'labaBerjalan',
            'labaDitahan',
        ]);
    }

    /** @test */
    public function export_returns_perubahanmodal_print_view_for_month()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('perubahanmodal.export', [
            'datepicker' => date('F Y'),
            'filter' => 'month',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.perubahanmodal');
        $response->assertViewHas([
            'modal',
            'penguranganModal',
            'datepicker',
            'today',
            'title',
            'labaBerjalan',
            'labaDitahan',
        ]);
    }

    /** @test */
    public function export_returns_perubahanmodal_print_view_for_year()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('perubahanmodal.export', [
            'datepicker' => date('Y'),
            'filter' => 'year',
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.perubahanmodal');
    }

    /** @test */
    public function get_date_returns_default_when_empty()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        [$date, $formatted, $filter] = $controller->getDate(null, null);

        $this->assertEquals('month', $filter);
        $this->assertEquals(now()->format('Y-m'), $date);
        $this->assertEquals(now()->format('F Y'), $formatted);
    }

    /** @test */
    public function get_date_parses_month_format()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        [$date, $formatted, $filter] = $controller->getDate('09-2025', 'month');

        $this->assertEquals('2025-09', $date);
        $this->assertEquals('September 2025', $formatted);
        $this->assertEquals('month', $filter);
    }

    /** @test */
    public function get_date_parses_year_format()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        [$date, $formatted, $filter] = $controller->getDate('2025', 'year');

        $this->assertEquals('2025', $date);
        $this->assertEquals('2025', $formatted);
        $this->assertEquals('year', $filter);
    }

    /** @test */
    public function get_transaction_filters_by_month_and_group()
    {
        $this->actingAsAdmin();
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        $group = \App\Models\AccountingGroup::factory()->create();
        $account = TransactionAccount::factory()->create();
        $account->accountinggroup()->attach($group->id);

        $transaction = Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'created_at' => now()->startOfMonth(),
        ]);

        $results = $controller->getTransaction(
            now()->format('Y-m'),
            'month',
            $group->id
        );

        $this->assertTrue(
            $results->pluck('id')->contains($transaction->id)
        );
    }

    /** @test */
    public function get_history_returns_monthly_history()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        $account = TransactionAccount::factory()->create();
        $history = HistoryReport::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'monthly',
            'created_at' => now(),
        ]);

        $result = $controller->getHistory('month', $account->id, now()->format('Y-m'));

        $this->assertEquals($history->id, $result->id);
    }

    /** @test */
    public function get_history_returns_annual_history()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        $account = TransactionAccount::factory()->create();
        $history = HistoryReport::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'annual',
            'created_at' => now(),
        ]);

        $result = $controller->getHistory('year', $account->id, now()->format('Y'));

        $this->assertEquals($history->id, $result->id);
    }

    /** @test */
    public function set_results_calculates_saldo_correctly()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();

        $group = \App\Models\AccountingGroup::factory()->create();

        $account = TransactionAccount::factory()->create([
            'lajurLaporan' => 'neraca',
        ]);
        $account->accountinggroup()->attach($group->id);

        HistoryReport::factory()->create([
            'transaction_accounts_id' => $account->id,
            'saldo' => 0,
            'type' => 'monthly',
            'created_at' => now(),
        ]);        

        Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'debit',
            'amount' => 100,
            'created_at' => now(),
        ]);

        $results = $controller->setResults(
            'month',
            now()->format('Y-m'),
            ['modal' => $group->id] // key bebas, di controller dipakai 'modal' & 'penguranganModal'
        );

        $this->assertEquals(
            100,
            $results['modal'][$account->id]['saldo'] ?? 0
        );
    }

    /** @test */
    public function get_laba_sums_correctly()
    {
        $controller = new \App\Http\Controllers\Report\PerubahanModalController();
    
        $accountLabaDitahan = TransactionAccount::factory()->create(['id' => 9999]);

        HistoryReport::factory()->create([
            'transaction_accounts_id' => $accountLabaDitahan->id,
            'saldo' => 1000,
            'type' => 'monthly',
            'created_at' => now()->startOfMonth(),
        ]);
    
        // Buat account untuk transaksi laba berjalan
        $account = TransactionAccount::factory()->create();
    
        // Buat AccountingGroup dinamis
        $groupPendapatan = \App\Models\AccountingGroup::factory()->create();
        $groupPengeluaran = \App\Models\AccountingGroup::factory()->create();
    
        // Attach account ke group pendapatan via pivot
        $account->accountinggroup()->attach($groupPendapatan->id);
    
        // Siapkan array accounting_group untuk controller
        $accounting_group = [
            'pendapatan' => $groupPendapatan->id,
            'pengeluaran' => $groupPengeluaran->id,
        ];
    
        // Buat transaksi dummy
        Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 500,
            'created_at' => now()->startOfMonth(),
        ]);
    
        // Panggil method getLaba
        $result = $controller->getLaba('month', now()->format('Y-m'), $accounting_group);
    
        $this->assertEquals(1000, $result[0]); // laba ditahan
        $this->assertEquals(500, $result[1]);  // laba berjalan
    }        
}
