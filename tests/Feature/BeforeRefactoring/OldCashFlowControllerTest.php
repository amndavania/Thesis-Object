<?php

namespace Tests\Feature\Report;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Report\CashFlowController;

class OldCashFlowControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        $this->actingAs($user);
        return $user;
    }

    /** @test */
    public function index_returns_cashflow_view()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('cashflow.index', [
            'datepicker' => now()->format('m-Y'),
            'filter' => 'month'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.cashflow');
        $response->assertViewHasAll([
            'arusKas', 'aset', 'penambahanDana', 'penguranganDana',
            'datepicker', 'filter', 'saldoAwal'
        ]);
    }

    /** @test */
    public function export_returns_cashflow_print_view_for_month()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('cashflow.export', [
            'datepicker' => now()->format('F Y'),
            'filter' => 'month'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.cashflow');
        $response->assertViewHasAll([
            'arusKas', 'aset', 'penambahanDana', 'penguranganDana',
            'datepicker', 'today', 'title', 'saldoAwal'
        ]);
    }

    /** @test */
    public function export_returns_cashflow_print_view_for_year()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('cashflow.export', [
            'datepicker' => now()->format('Y'),
            'filter' => 'year'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.cashflow');
        $response->assertViewHas('title', 'Laporan Arus Kas');
    }

    /** @test */
    public function get_date_returns_default_when_empty()
    {
        $controller = new CashFlowController();

        [$date, $formatted, $filter] = $controller->getDate(null, null);

        $this->assertEquals('month', $filter);
        $this->assertEquals(now()->format('Y-m'), $date);
        $this->assertEquals(now()->format('F Y'), $formatted);
    }

    /** @test */
    public function get_date_parses_month_format()
    {
        $controller = new CashFlowController();
        [$date, $formatted, $filter] = $controller->getDate('09-2025', 'month');

        $this->assertEquals('2025-09', $date);
        $this->assertEquals('September 2025', $formatted);
        $this->assertEquals('month', $filter);
    }

    /** @test */
    public function get_date_parses_year_format()
    {
        $controller = new CashFlowController();
        [$date, $formatted, $filter] = $controller->getDate('2025', 'year');

        $this->assertEquals('2025', $date);
        $this->assertEquals('2025', $formatted);
        $this->assertEquals('year', $filter);
    }

    /** @test */
    public function get_transaction_filters_by_month_and_group()
    {
        $this->actingAsAdmin();
        $controller = new CashFlowController();

        $group = \App\Models\AccountingGroup::factory()->create();

        $account = TransactionAccount::factory()->create();
        $account->accountinggroup()->attach($group->id); // pakai pivot
        
        // Buat Transaction yang nyambung ke account ini
        $transaction = Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'created_at' => now()->startOfMonth(),
        ]);

        $results = $controller->getTransaction(
            now()->format('Y-m'),
            'month',
            $group->id //pakai id dinamis
        );

        $this->assertTrue(
            $results->pluck('id')->contains($transaction->id)
        );
    }

    /** @test */
    public function get_history_returns_monthly_history()
    {
        $controller = new CashFlowController();

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
        $controller = new CashFlowController();

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
        $controller = new CashFlowController();
    
        $group = \App\Models\AccountingGroup::factory()->create();
    
        $account = TransactionAccount::factory()->create([
            'lajurLaporan' => 'neraca',
        ]);
    
        $account->accountinggroup()->attach($group->id);
    
        Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'debit',
            'amount' => 100,
            'created_at' => now(),
        ]);
    
        $results = $controller->setResults(
            'month',
            now()->format('Y-m'),
            ['arusKas' => $group->id] // pakai id dinamis
        );
    
        $this->assertEquals(
            100,
            $results['arusKas'][$account->id]['saldo'] ?? 0
        );
    }
    

    /** @test */
    public function get_saldo_awal_sums_correctly_for_month()
    {
        $controller = new CashFlowController();

        HistoryReport::factory()->create([
            'type' => 'monthly',
            'saldo' => 5000,
            'created_at' => now(),
        ]);

        $saldoAwal = $controller->getSaldoAwal('month', now()->format('Y-m'));

        $this->assertEquals(5000, $saldoAwal);
    }

    /** @test */
    public function get_saldo_awal_sums_correctly_for_year()
    {
        $controller = new CashFlowController();

        HistoryReport::factory()->create([
            'type' => 'annual',
            'saldo' => 8000,
            'created_at' => now(),
        ]);

        $saldoAwal = $controller->getSaldoAwal('year', now()->format('Y'));

        $this->assertEquals(8000, $saldoAwal);
    }
}
