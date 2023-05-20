<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_accounts_id',
        'ammount_kredit',
        'ammount_debit',
    ];

    protected $hidden = [];

    public function transactionaccount(): BelongsTo
    {
        return $this->belongsTo(TransactionAccount::class);
    }
}
