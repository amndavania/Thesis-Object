<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('student_types')->insert([
            [
                'id' => 1,
                'type' => 'Reguler',
                'year' => '2024',
                'study_program_id' => 1,
                'dpp' => 1000000,
                'krs' => 500000,
                'uts' => 300000,
                'uas' => 300000,
                'wisuda' => 400000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'type' => 'Beasiswa',
                'year' => '2024',
                'study_program_id' => 2,
                'dpp' => 0,
                'krs' => 0,
                'uts' => 0,
                'uas' => 0,
                'wisuda' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
