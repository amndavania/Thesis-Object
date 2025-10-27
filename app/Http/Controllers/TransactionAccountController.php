<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionAccount\TransactionAccountCreateRequest;
use App\Http\Requests\TransactionAccount\TransactionAccountUpdateRequest;
use App\Models\AccountingGroup;
use App\Models\TransactionAccount;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Repositories\TransactionAccountRepositoryInterface;

class TransactionAccountController extends Controller
{
    protected $transactionAccountRepo;

    public function __construct(TransactionAccountRepositoryInterface $transactionAccountRepo)
    {
        $this->transactionAccountRepo = $transactionAccountRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // query simple → biarin di controller
        return view('transaction_account.data')->with([
            'transaction_account' => TransactionAccount::latest()->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // query simple → biarin di controller
        $accounting_group = AccountingGroup::all();
        return view('transaction_account.create',  compact('accounting_group'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionAccountCreateRequest $request)
    {
        $this->transactionAccountRepo->create(
            $request->except('accounting_group_id'),
            $request->input('accounting_group_id', [])
        );

        return redirect()->route('transaction_account.index')->with(['success' => 'Data berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $transaction_account = $this->transactionAccountRepo->findById($id);
        $accounting_group = AccountingGroup::all();
        return view('transaction_account.edit', compact('transaction_account', 'accounting_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    // controller
    public function update(TransactionAccountUpdateRequest $request, string $id): RedirectResponse
    {
        $this->transactionAccountRepo->update(
            $id,
            $request->except('accounting_group_id'),
            $request->input('accounting_group_id', [])
        );

        return redirect()->route('transaction_account.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        if ($this->transactionAccountRepo->isProtected($id)) {
            return redirect()->route('transaction_account.index')->with(['warning' => 'Akun Transaksi tidak dapat dihapus']);
        } elseif ($this->transactionAccountRepo->hasTransaction($id)) {
            return redirect()->route('transaction_account.index')->with(['warning' => 'Akun Transaksi sedang dipakai di Data Transaksi']);
        } elseif ($this->transactionAccountRepo->hasHistory($id)) {
            return redirect()->route('transaction_account.index')->with(['warning' => 'Akun Transaksi sedang dipakai di History Transaksi']);
        } else {
            $this->transactionAccountRepo->delete($id);
            return redirect()->route('transaction_account.index')->with(['success' => 'Data berhasil dihapus']);
        }
    }
}


