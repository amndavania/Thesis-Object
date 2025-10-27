<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionCreateRequest;
use App\Http\Requests\Transaction\TransactionUpdateRequest;
use App\Models\Transaction;
use App\Models\TransactionAccount;
use App\Models\Ukt;
use App\Repositories\TransactionRepositoryInterface;

class TransactionController extends Controller
{
    protected $transactionRepo;

    public function __construct(TransactionRepositoryInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
    }

    public function index()  //not include
    {
        return view('transaction.data')->with([
            'transaction' => Transaction::latest()->paginate(20),
        ]);
    }

    public function create()  //not include
    {
        $transaction_account = TransactionAccount::all();
        return view('transaction.create', compact('transaction_account'));
    }

    public function store(TransactionCreateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $this->transactionRepo->create($data);

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function edit(int $id)
    {
        if ($this->transactionRepo->hasUktRelation($id)) {
            return redirect()->route('transaction.index')->with(['warning' => 'Mohon edit melalui menu Pembayaran Mahasiswa']);
        }

        return view('transaction.edit')->with([
            'transaction' => Transaction::findOrFail($id),
            'transaction_account' => TransactionAccount::all(),
        ]);
    }

    public function update(TransactionUpdateRequest $request, string $id)
    {
        $this->transactionRepo->update($id, $request->all());

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil diupdate']);
    }

    public function destroy(string $id)
    {
        if (!$this->transactionRepo->hasUktRelation($id)) {
            $this->transactionRepo->delete($id);
            return redirect()->route('transaction.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->route('transaction.index')->with(['warning' => 'Mohon hapus melalui menu Pembayaran Mahasiswa']);
        }
    }
}
