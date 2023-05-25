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

    protected $fillable = [
        'id',
        'name',
        'description',
        'ammount_kredit',
        'ammount_debit',
        'accounting_group_id',
    ];

    protected $hidden = [];

    public function accountinggroup(): BelongsTo
    {
        return $this->belongsTo(AccountingGroup::class);
    }

    public function transaction(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function Ukt(): HasMany
    {
        return $this->hasMany(Ukt::class);
    }
}
