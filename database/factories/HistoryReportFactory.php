<?php

namespace Database\Factories;

use App\Models\HistoryReport;
use App\Models\TransactionAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryReport>
 */
class HistoryReportFactory extends Factory
{
    protected $model = HistoryReport::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_accounts_id' => TransactionAccount::factory(),
            'type' => 'monthly', // biar konsisten sama test case
            'saldo' => $this->faker->numberBetween(0, 1000000),
        ];
    }
}
