<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reference_number',
        'amount',
        'type',
        'transaction_accounts_id',
    ];

    protected $hidden = [];

    public function transactionaccount(): BelongsToMany
    {
        return $this->belongsToMany(TransactionAccount::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
