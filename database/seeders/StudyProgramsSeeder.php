<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyProgramsSeeder extends Seeder
{
    public function run()
    {
        DB::table('study_programs')->insert([
            [
                'id' => 1,
                'name' => 'Teknik Informatika',
                'kaprodi_name' => 'Dr. Budi Santoso',
                'faculty_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Manajemen',
                'kaprodi_name' => 'Dr. Ani Wijaya',
                'faculty_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
