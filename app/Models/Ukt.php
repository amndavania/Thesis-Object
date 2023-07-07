<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ukt extends Model
{
    use HasFactory;

    protected $fillable = [
        'students_id',
        'year',
        'semester',
        'type',
        'reference_number',
        'amount',
        'status',
        'transaction_debit_id',
        'transaction_kredit_id',
    ];


    public function student_id(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'students_id');
    }


    // public function transactionaccount(): BelongsTo
    // {
    //     return $this->belongsTo(TransactionAccount::class, 'transaction_accounts_id');
    // }

    // public function transactiondebit(): BelongsTo
    // {
    //     return $this->belongsTo(Transaction::class, 'transaction_debit_id');
    // }

    // public function transactionkredit(): BelongsTo
    // {
    //     return $this->belongsTo(Transaction::class, 'transaction_kredit_id');
    // }
}
