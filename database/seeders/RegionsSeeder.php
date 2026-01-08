<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('regions')->insert([
            ['name' => 'Eriador'],
            ['name' => 'Rhovanion'],
            ['name' => 'Mordor'],
            ['name' => 'Gondor'],
            ['name' => 'Rohan'],
        ]);
    }
}
