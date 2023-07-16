<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TransactionAccount extends Model
{
    use HasFactory;

    protected $table = 'transaction_accounts';
    protected $fillable = [
        'id',
        'name',
        'description',
        'kredit',
        'debit',
        'accounting_group_id',
    ];

    protected $hidden = [];

    public function accountinggroup()
    {
        return $this->belongsToMany(AccountingGroup::class, 'accounting_group_transaction_account', 'transaction_account_id', 'accounting_group_id');
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class, 'transaction_accounts_id');
    }

    public function Ukt(): HasMany
    {
        return $this->hasMany(Ukt::class);
    }

    public function historyreport(): HasMany
    {
        return $this->hasMany(HistoryReport::class);
    }
}
