<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BimbinganStudy extends Model
{
    use HasFactory;

    protected $table = 'bimbingan_study';
    protected $fillable = [
        'students_id',
        'year',
        'semester',
        'status'
    ];

    protected $hidden = [];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'students_id');
    }

}
