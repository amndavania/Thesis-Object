<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExamCard>
 */
class ExamCardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'students_id'=>mt_rand(1,999),
            'type'=>fake()->randomElement(['UTS','UAS']),
            'semester'=>fake()->randomElement(['GASAL','GENAP']),
            'year' => fake()->numberBetween(1996, 2023). "/". fake()->numberBetween(1996, 2023),
        ];
    }
}
