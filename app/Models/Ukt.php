<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'created_at',
        'keterangan',
        'lbs_id',
        'exam_uts_id',
        'exam_uas_id',
    ];

    public function student_id(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'students_id');
    }
}
