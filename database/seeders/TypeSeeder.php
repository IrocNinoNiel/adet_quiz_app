<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([[
            'name' => 'admin',
            'description' => 'admin',
        ],[
            'name' => 'teacher',
            'description' => 'teacher',
        ],[
            'name' => 'student',
            'description' => 'student',
        ]]);
    }
}
