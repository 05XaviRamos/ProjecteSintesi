<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zones')->insert([
            ['name' => 'Tamesur', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MEWA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vicor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TV planes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AACC', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Descontaminació', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tobogan', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Piraña', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
