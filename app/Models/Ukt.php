<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ukt extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'amount',
        'type',
        'transaction_accounts_id',
    ];


    public function student_id(): HasOne
    {
        return $this->hasOne(Student::class);
    }


    public function transactionaccount(): BelongsToMany
    {
        return $this->belongsToMany(TransactionAccount::class);
    }
}
