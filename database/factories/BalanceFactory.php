<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balance>
 */
class BalanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'transaction_accounts_id'=>mt_rand(1,10),
            'ammount_kredit'=>fake()->randomFloat(1, 10, 30),
            'ammount_debit'=>fake()->randomFloat(1, 20, 30),
        ];
    }
}
