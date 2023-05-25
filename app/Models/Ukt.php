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
        'sudents_id',
        'reference_number',
        'amount',
        'type',
        'transaction_accounts_id',
    ];


    public function student_id(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }


    public function transactionaccount(): BelongsTo
    {
        return $this->belongsTo(TransactionAccount::class);
    }
}
