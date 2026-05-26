<?php

namespace Database\Seeders;

use App\Models\Containers as Container;
use App\Models\Zones as Zone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZonesContainersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zones__containers')->insert([
            ['zone_id' => Zone::where('name', 'Tamesur')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (PILAGEST) 0.6m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'TV planes')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (PILAGEST) 0.6m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'AACC')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (PILAGEST) 0.6m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Descontaminació')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (PILAGEST) 0.6m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Tobogan')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (PILAGEST) 0.6m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],

            ['zone_id' => Zone::where('name', 'Tamesur')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'MEWA')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Vicor')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'TV planes')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'AACC')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Descontaminació')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Tobogan')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Piraña')->first()->id, 'container_id' => Container::where('name', 'CESTÓ INTERN (IRSA) 1,7m3')->first()->id, 'created_at' => now(), 'updated_at' => now()],

            ['zone_id' => Zone::where('name', 'Vicor')->first()->id, 'container_id' => Container::where('name', 'CONTENIDOR FERRO INTERN')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Vicor')->first()->id, 'container_id' => Container::where('name', 'CONTENIDOR VIDRE INTERN')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Tobogan')->first()->id, 'container_id' => Container::where('name', 'GÀBIA BLAVA DEIXALLERIA')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Tobogan')->first()->id, 'container_id' => Container::where('name', 'GÀBIA NEGRA DEIXALLERIA')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Descontaminació')->first()->id, 'container_id' => Container::where('name', 'PALET EUROPEU 800X1200')->first()->id, 'created_at' => now(), 'updated_at' => now()],

            ['zone_id' => Zone::where('name', 'Tamesur')->first()->id, 'container_id' => Container::where('name', 'GRG')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'MEWA')->first()->id, 'container_id' => Container::where('name', 'GRG')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'TV planes')->first()->id, 'container_id' => Container::where('name', 'GRG')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'AACC')->first()->id, 'container_id' => Container::where('name', 'GRG')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Descontaminació')->first()->id, 'container_id' => Container::where('name', 'GRG')->first()->id, 'created_at' => now(), 'updated_at' => now()],
            ['zone_id' => Zone::where('name', 'Tobogan')->first()->id, 'container_id' => Container::where('name', 'GRG')->first()->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
