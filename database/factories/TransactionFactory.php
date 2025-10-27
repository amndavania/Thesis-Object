<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TransactionAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Transactions>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory()->create()->id,
            'reference_number'=>fake()->randomNumber(7, true),
            'amount'=>fake()->numberBetween(1000, 1000000),
            'type'=>fake()->randomElement(['kredit','debit']),
            'transaction_accounts_id' => TransactionAccount::query()->inRandomOrder()->value('id') ?? TransactionAccount::factory()->create()->id,
            'description'=>fake()->sentence(),
        ];
    }
}
