<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountingGroup extends Model
{
    use HasFactory;
    protected $table = 'accounting_groups';
    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    protected $hidden = [];

    // public function transactionaccount(): HasMany
    // {
    //     return $this->hasMany(TransactionAccount::class);
    // }

    public function transactionaccount()
    {
        return $this->belongsToMany(TransactionAccount::class, 'accounting_group_transaction_account', 'transaction_account_id', 'accounting_group_id');
    }
}
