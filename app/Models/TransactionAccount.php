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
        'accountinggroup_id',
        'description',
    ];

    protected $hidden = [];

    public function accountinggroup(): BelongsTo
    {
        return $this->belongsTo(AccountingGroup::class);
    }

    public function transaction(): BelongsToMany
    {
        return $this->belongsToMany(Transaction::class);
    }

    public function Ukt(): BelongsToMany
    {
        return $this->belongsToMany(Ukt::class);
    }

    public function balance(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
