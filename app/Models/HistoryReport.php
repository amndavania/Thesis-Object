<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HistoryReport extends Model
{
    use HasFactory;

    protected $table = 'history_report';

    protected $fillable = [
        'transaction_accounts_id',
        'type',
        'kredit',
        'debit'
    ];

    public function transactionaccount(): BelongsTo
    {
        return $this->belongsTo(TransactionAccount::class,'transaction_accounts_id');
    }
}
