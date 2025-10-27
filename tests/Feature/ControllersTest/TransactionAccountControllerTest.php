<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\TransactionAccount;
use App\Models\AccountingGroup;
use App\Models\Transaction;
use App\Models\HistoryReport;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionAccountControllerTest extends TestCase
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

        $response = $this->get(route('transaction_account.index'));

        $response->assertStatus(200);
        $response->assertViewIs('transaction_account.data');
    }

    /** @test */
    public function create_page_can_be_loaded()
    {
        $this->actingAsAdmin();

        $response = $this->get(route('transaction_account.create'));

        $response->assertStatus(200);
        $response->assertViewIs('transaction_account.create');
    }

    /** @test */
    public function transaction_account_can_be_created_with_groups()
    {
        $this->actingAsAdmin();

        $group1 = AccountingGroup::factory()->create();
        $group2 = AccountingGroup::factory()->create();

        $data = [
            'name' => 'Kas Besar',
            'id' => '1010', // field wajib
            'lajurSaldo' => 'debit',
            'lajurLaporan' => 'labaRugi',
            'description' => 'Akun kas besar',
            'accounting_group_id' => [$group1->id, $group2->id],
        ];

        $response = $this->post(route('transaction_account.store'), $data);

        $response->assertRedirect(route('transaction_account.index'));
        $this->assertDatabaseHas('transaction_accounts', [
            'name' => 'Kas Besar',
            'id' => '1010',
            'lajurSaldo' => 'debit',
            'lajurLaporan' => 'labaRugi',
        ]);
    }

    /** @test */
    public function transaction_account_can_be_updated()
    {
        $this->actingAsAdmin();

        $group1 = AccountingGroup::factory()->create();

        $account = TransactionAccount::factory()->create([
            'name' => 'Kas Lama',
            'id' => '1000',
            'lajurSaldo' => 'debit',
            'lajurLaporan' => 'labaRugi',
        ]);

        $data = [
            'name' => 'Kas Baru',
            'id' => '2020', // field wajib
            'lajurSaldo' => 'kredit',
            'lajurLaporan' => 'neraca',
            'accounting_group_id' => [$group1->id],
        ];

        $response = $this->put(route('transaction_account.update', $account->id), $data);

        $response->assertRedirect(route('transaction_account.index'));
        $this->assertDatabaseHas('transaction_accounts', [
            'id' => $account->id,
            'name' => 'Kas Baru',
            'id' => '2020',
            'lajurSaldo' => 'kredit',
            'lajurLaporan' => 'neraca',
        ]);
    }

    /** @test */
    public function transaction_account_cannot_be_deleted_if_protected()
    {
        $this->actingAsAdmin();

        $protected = TransactionAccount::factory()->create(['id' => 1130]);

        $response = $this->delete(route('transaction_account.destroy', $protected->id));

        $response->assertRedirect(route('transaction_account.index'));
        $response->assertSessionHas('warning');
        $this->assertDatabaseHas('transaction_accounts', ['id' => 1130]);
    }

    /** @test */
    public function transaction_account_edit_page_can_be_loaded()
    {
        $this->actingAsAdmin();

        $account = TransactionAccount::factory()->create();

        $response = $this->get(route('transaction_account.edit', $account->id));

        $response->assertStatus(200);
        $response->assertViewIs('transaction_account.edit');
        $response->assertViewHas('transaction_account');
        $response->assertViewHas('accounting_group');
    }


    /** @test */
    public function transaction_account_cannot_be_deleted_if_has_transaction()
    {
        $this->actingAsAdmin();

        $account = TransactionAccount::factory()->create();
        Transaction::factory()->create(['transaction_accounts_id' => $account->id]);

        $response = $this->delete(route('transaction_account.destroy', $account->id));

        $response->assertRedirect(route('transaction_account.index'));
        $response->assertSessionHas('warning');
        $this->assertDatabaseHas('transaction_accounts', ['id' => $account->id]);
    }

    /** @test */
    public function transaction_account_cannot_be_deleted_if_has_history()
    {
        $this->actingAsAdmin();

        $account = TransactionAccount::factory()->create();
        HistoryReport::factory()->create(['transaction_accounts_id' => $account->id]);

        $response = $this->delete(route('transaction_account.destroy', $account->id));

        $response->assertRedirect(route('transaction_account.index'));
        $response->assertSessionHas('warning');
        $this->assertDatabaseHas('transaction_accounts', ['id' => $account->id]);
    }

    /** @test */
    public function transaction_account_can_be_deleted_if_no_relations_and_not_protected()
    {
        $this->actingAsAdmin();

        $account = TransactionAccount::factory()->create();

        $response = $this->delete(route('transaction_account.destroy', $account->id));

        $response->assertRedirect(route('transaction_account.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('transaction_accounts', ['id' => $account->id]);
    }
}
