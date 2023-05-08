<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [];

    public function studyprogram(): HasMany
    {
        return $this->hasMany(StudyProgram::class);
    }
}
