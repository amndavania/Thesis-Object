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
            'name' => "Akun ".fake()->word(),
            'description' => fake()->sentence(),
        ];
    }
}
