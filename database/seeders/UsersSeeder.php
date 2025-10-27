<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 10 user role DPA
        User::factory()->count(10)->create([
            'role' => 'DPA',
        ]);
    }
}
