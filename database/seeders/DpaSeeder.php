<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dpa;
use App\Models\User;

class DpaSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'DPA')->take(5)->get();

        foreach ($users as $index => $user) {
            Dpa::create([
                'name' => 'Dosen ' . chr(65 + $index), // A, B, C...
                'email' => 'dosen.' . strtolower(chr(97 + $index)) . '@example.com',
                'user_id' => $user->id, // <- pakai ID yang valid
                'study_program_id' => 1,
            ]);
        }
    }
}
