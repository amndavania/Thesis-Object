<?php

namespace Database\Factories;

use App\Models\AccountingGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountingGroup>
 */
class AccountingGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = AccountingGroup::class;

    public function definition(): array
    {
         return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            // 'name' => $this->faker->word,
            // 'description' => $this->faker->text,
            // 'updated_at' => now(),
            // 'created_at' => now(),
        ];
    }
}
