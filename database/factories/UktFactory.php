<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Ukt>
 */
class UktFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reference_number'=>fake()->randomNumber(5, true),
            'amount'=>fake()->randomFloat(1, 10, 30),
            'type'=>fake()->word(),
            'status'=>fake()->word(),
            'transaction_accounts_id'=>mt_rand(1,10),
        ];
    }
}
