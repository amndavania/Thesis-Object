<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\TransactionAccount;
use App\Models\HistoryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BukuBesarRekapControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }

    /** @test */
    public function it_loads_index_page_with_default_date()
    {
        $this->actingAsAdmin(); 
        $response = $this->get(route('bukubesarrekap.index'));

        $response->assertStatus(200);
        $response->assertViewIs('report.bukubesarrekap');
        $response->assertViewHas(['data', 'datepicker']);
    }

    /** @test */
    public function it_can_export_report()
    {
        $this->actingAsAdmin(); 
        $response = $this->get(route('bukubesarrekap.export', [
            'datepicker' => 'June 2024'
        ]));

        $response->assertStatus(200);
        $response->assertViewIs('report.printformat.bukubesarrekap');
        $response->assertViewHasAll(['data', 'datepicker', 'today', 'title']);
    }

    /** @test */
    public function it_parses_datepicker_when_given()
    {
        $this->actingAsAdmin(); 
        $controller = new \App\Http\Controllers\Report\BukuBesarRekapController();
        [$date, $formatted] = $controller->getDate('06-2024', '2024-09');

        $this->assertEquals('2024-06', $date);
        $this->assertEquals('June 2024', $formatted);
    }

    /** @test */
    public function it_uses_current_month_when_datepicker_empty()
    {
        $this->actingAsAdmin(); 
        $controller = new \App\Http\Controllers\Report\BukuBesarRekapController();
        [$date, $formatted] = $controller->getDate(null, date('Y-m'));

        $this->assertEquals(date('Y-m'), $date);
        $this->assertEquals(date('F Y'), $formatted);
    }

    /** @test */
    public function it_returns_data_from_getData_for_current_month()
    {
        $this->actingAsAdmin(); 
        $account = TransactionAccount::factory()->create([
            'lajurLaporan' => 'neraca',
            'lajurSaldo' => 'debit',
            'debit' => 200,
            'kredit' => 100,
        ]);

        HistoryReport::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'monthly',
            'created_at' => now(),
            'saldo' => 500,
        ]);

        $controller = new \App\Http\Controllers\Report\BukuBesarRekapController();
        $data = $controller->getData(now()->format('Y-m'), now()->format('Y-m'));

        $this->assertArrayHasKey($account->id, $data);
        $this->assertEquals(600, $data[$account->id]['debit']); // 500 + (200-100)
    }

    /** @test */
    public function it_returns_data_from_getData_for_previous_month()
    {
        $this->actingAsAdmin(); 
        $account = TransactionAccount::factory()->create([
            'lajurLaporan' => 'labaRugi',
            'lajurSaldo' => 'kredit',
        ]);

        HistoryReport::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'monthly',
            'created_at' => now()->addMonth(),
            'saldo' => 1000,
        ]);

        $controller = new \App\Http\Controllers\Report\BukuBesarRekapController();
        $data = $controller->getData(now()->format('Y-m'), now()->subMonth()->format('Y-m'));

        $this->assertArrayHasKey($account->id, $data);
        $this->assertEquals(-1000, $data[$account->id]['kredit']);
    }
}
