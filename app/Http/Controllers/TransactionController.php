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

    /**
     * Display a listing of the resource.
     */
    public function index()  
    //not include
    {
        return view('transaction.data')->with([
            'transaction' => Transaction::latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()  
    //not include
    {
        $transaction_account = TransactionAccount::all();
        return view('transaction.create', compact('transaction_account'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionCreateRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $this->transactionRepo->create($data);

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil disimpan']);
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

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, string $id)
    {
        $this->transactionRepo->update($id, $request->all());

        return redirect()->route('transaction.index')->with(['success' => 'Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
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
