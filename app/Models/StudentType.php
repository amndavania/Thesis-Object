<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'dpp',
        'krs',
        'uts',
        'wisuda',
    ];

    protected $hidden = [];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }
}
