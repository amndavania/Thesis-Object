<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function actingAsAdmin()
    {
        $user = User::factory()->create(['role' => 'super admin']);
        return $this->actingAs($user);
    }

    /** @test */
    public function index_page_can_be_loaded()
    {
        $this->actingAsAdmin();
        $response = $this->get(route('transaction.index'));

        $response->assertStatus(200);
        $response->assertViewIs('transaction.data');
    }

    /** @test */
    public function create_page_can_be_loaded()
    {
        $this->actingAsAdmin();
        $response = $this->get(route('transaction.create'));

        $response->assertStatus(200);
        $response->assertViewIs('transaction.create');
    }

    /** @test */
    public function transaction_can_be_stored_and_update_account_balance()
    {
        $this->actingAsAdmin();
        $account = TransactionAccount::factory()->create(['kredit' => 0, 'debit' => 0]);

        $data = [
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 1000,
            'created_at' => now()->format('Y-m-d'),
            'description' => 'Test transaksi',
        ];

        $response = $this->post(route('transaction.store'), $data);

        $response->assertRedirect(route('transaction.index'));
        $this->assertDatabaseHas('transactions', [
            'transaction_accounts_id' => $account->id,
            'amount' => 1000,
        ]);

        $this->assertDatabaseHas('transaction_accounts', [
            'id' => $account->id,
            'kredit' => 1000,
        ]);
    }

    /** @test */
    public function transaction_can_be_updated_and_account_balance_adjusted()
    {
        $this->actingAsAdmin();
        $account = TransactionAccount::factory()->create(['kredit' => 0, 'debit' => 0]);

        $transaction = Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 500,
        ]);

        $account->update(['kredit' => 500]); // sync awal

        $response = $this->put(route('transaction.update', $transaction->id), [
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 800,
            'description' => 'Updated transaksi',
        ]);

        $response->assertRedirect(route('transaction.index'));
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'amount' => 800,
        ]);

        // saldo harus naik 300 (800 - 500)
        $this->assertDatabaseHas('transaction_accounts', [
            'id' => $account->id,
            'kredit' => 800,
        ]);
    }

    /** @test */
    public function transaction_can_be_deleted_and_account_balance_adjusted()
    {
        $this->actingAsAdmin();
        $account = TransactionAccount::factory()->create(['kredit' => 1000, 'debit' => 0]);

        $transaction = Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 1000,
        ]);

        $response = $this->delete(route('transaction.destroy', $transaction->id));

        $response->assertRedirect(route('transaction.index'));
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);

        // saldo berkurang 1000
        $this->assertDatabaseHas('transaction_accounts', [
            'id' => $account->id,
            'kredit' => 0,
        ]);
    }

    /** @test */
    public function edit_page_redirects_if_transaction_has_ukt_relation()
    {
        $this->actingAsAdmin();
        $account = \App\Models\TransactionAccount::factory()->create();
        $transaction = \App\Models\Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 500,
        ]);

        // bikin student valid dulu
        $student = \App\Models\Student::factory()->create();

        // tambahkan relasi UKT dengan student yang valid
        \App\Models\Ukt::factory()->create([
            'transaction_debit_id' => $transaction->id,
            'students_id' => $student->id,
        ]);

        $response = $this->get(route('transaction.edit', $transaction->id));

        $response->assertRedirect(route('transaction.index'));
        $response->assertSessionHas('warning');
    }


    /** @test */
    public function edit_page_can_be_loaded_if_no_ukt_relation()
    {
        $this->actingAsAdmin();
        $account = TransactionAccount::factory()->create();
        $transaction = Transaction::factory()->create([
            'transaction_accounts_id' => $account->id,
            'type' => 'kredit',
            'amount' => 500,
        ]);

        $response = $this->get(route('transaction.edit', $transaction->id));

        $response->assertStatus(200);
        $response->assertViewIs('transaction.edit');
    }
}
