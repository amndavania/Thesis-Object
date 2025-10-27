<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultiesSeeder extends Seeder
{
    public function run()
    {
        DB::table('faculties')->insert([
            [
                'id' => 1,
                'name' => 'Fakultas Teknik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Fakultas Ekonomi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
