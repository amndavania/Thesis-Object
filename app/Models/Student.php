<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nim',
        'birth',
        'study_program',
        'force',
        'ukt_id',
    ];

    protected $hidden = [];

    public function ukt(): BelongsTo
    {
        return $this->belongsTo(Ukt::class);
    }

    public function studyprogram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function faculty(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
}
