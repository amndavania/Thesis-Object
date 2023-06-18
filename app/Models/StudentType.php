<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentType extends Model
{
    use HasFactory;

    protected $table = 'student_types';
    protected $fillable = [
        'type',
        'year',
        'study_program_id',
        'dpp',
        'krs',
        'uts',
        'uas',
        'wisuda',
    ];

    protected $hidden = [];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function studyprogram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }
}
