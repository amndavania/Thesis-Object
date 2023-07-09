<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudyProgram extends Model
{
    use HasFactory;

    protected $table = 'study_programs';
    protected $fillable = [
        'name',
        'kaprodi_name',
        'faculty_id',
    ];

    protected $hidden = [];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function dpa(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function studentType(): HasMany
    {
        return $this->hasMany(StudentType::class);
    }
}
