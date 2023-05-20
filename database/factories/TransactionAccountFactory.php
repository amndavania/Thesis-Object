<?php

namespace Database\Factories;

use App\Models\AccountingGroup;
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
            // 'id' => random_int(1,100), 
            'name' => $this->faker->word,
            'accounting_group_id' => mt_rand(1,10),
            'description' => $this->faker->text,
        ];
    }
}
