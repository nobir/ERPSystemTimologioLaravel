<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::factory()->count(10)->create();
    }
}
