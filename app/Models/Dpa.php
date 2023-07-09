<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dpa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'user_id',
    ];


    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function student(): HasMany
    {
        return $this->hasMany(User::class, 'student_id');
    }

    public function studyprogram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
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
