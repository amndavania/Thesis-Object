<?php

namespace Database\Factories;

use App\Models\TransactionAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionAccount>
 */
class TransactionAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Akun Transaksi ".$this->faker->word,
            'description' => $this->faker->text,
            'debit'=>fake()->numberBetween(10000, 1000000),
            'kredit'=>fake()->numberBetween(10000, 1000000),
        ];
    }
}
