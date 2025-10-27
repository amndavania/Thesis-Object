<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountingGroup extends Model
{
    use HasFactory;
    protected $table = 'accounting_groups'; //'accounting_groups' adalah string literal (token T_CONSTANT_ENCAPSED_STRING). Itu hanya nilai dari variabel $table, bukan nama variabel, bukan nama fungsi, bukan class name, bukan konstanta.
    protected $fillable = [ //id, name, description (dalam array) tidak dihitung operand.
        'id',
        'name',
        'description',
    ];

    protected $hidden = [];

    // public function transactionaccount(): HasMany
    // {
    //     return $this->hasMany(TransactionAccount::class);
    // }

    public function transactionAccounts()
    {
        return $this->belongsToMany(TransactionAccount::class, 'accounting_group_transaction_account', 'accounting_group_id', 'transaction_account_id');
    }
}
