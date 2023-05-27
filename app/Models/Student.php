<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = [
        'name',
        'nim',
        'force',
        'student_types_id',
        'study_program_id',
    ];

    protected $hidden = [];

    public function ukt(): HasMany
    {
        return $this->hasMany(Ukt::class);
    }

    public function studyprogram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id');
    }

    public function studenttype(): BelongsTo
    {
        return $this->belongsTo(StudentType::class,'student_types_id');
    }
}
