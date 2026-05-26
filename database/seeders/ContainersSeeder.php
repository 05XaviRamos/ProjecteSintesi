<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContainersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('containers')->insert([
            ['name' => 'CESTÓ INTERN (PILAGEST) 0.6m3', 'weight' => 83, 'input' => true, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CESTÓ INTERN (IRSA) 1,7m3', 'weight' => 227, 'input' => true, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CONTENIDOR FERRO INTERN', 'weight' => 419, 'input' => false, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CONTENIDOR VIDRE INTERN', 'weight' => 232, 'input' => false, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GÀBIA BLAVA DEIXALLERIA', 'weight' => 214, 'input' => true, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GÀBIA BLAVA DEIXALLERIA TAPA', 'weight' => 276, 'input' => true, 'output' => false, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GÀBIA NEGRA DEIXALLERIA', 'weight' => 191, 'input' => true, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PALET EUROPEU 800X1200', 'weight' => 18, 'input' => true, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'GRG', 'weight' => 42, 'input' => true, 'output' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
