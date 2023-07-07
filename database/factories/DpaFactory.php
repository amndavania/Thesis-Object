<?php

namespace Database\Factories;

use App\Models\Dpa;
use Illuminate\Database\Eloquent\Factories\Factory;

class DpaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Dpa::class;

    public function definition(): array
    {
         return [
            'name' => "Dosen ".fake()->word(),
            'email' => fake()->unique()->safeEmail(),
            'user_id'=>mt_rand(4,44),
        ];
    }
}
