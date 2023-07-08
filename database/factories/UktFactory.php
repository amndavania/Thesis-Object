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
            'amount'=>fake()->numberBetween(100000, 1000000),
            // 'total'=>fake()->numberBetween(100000, 1000000),
            'status'=>fake()->randomElement(['Lunas','Belum Lunas']),
            'transaction_debit_id'=>mt_rand(1,10),
            'transaction_kredit_id'=>mt_rand(1,10),
            'students_id'=>mt_rand(1,999),
            'semester'>fake()->randomElement(['GASAL','GENAP']),
            'type'=>fake()->randomElement(['UKT','DPP','WISUDA']),
            'year' => fake()->numberBetween(1996, 2023),
            'keterangan'=>fake()->text(),
            // not set up yet
            'lbs_id'=> 1,
            'exam_uts_id'=> 1,
            'exam_uas_id'=> 1,
        ];
    }
}
