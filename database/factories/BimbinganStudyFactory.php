<?php

namespace Database\Factories;

use App\Models\BimbinganStudy;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class BimbinganStudyFactory extends Factory
{
    protected $model = BimbinganStudy::class;

    public function definition(): array
    {
        return [
            'students_id' => Student::factory(), // biar otomatis buat Student dulu, dan ambil ID-nya
            'year' => $this->faker->year,
            'semester' => $this->faker->randomElement(['GASAL', 'GENAP']),
            'status' => $this->faker->randomElement(['Tunda','Aktif']),
        ];
    }
}
