<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VacationDetail;

class VacationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VacationDetail::factory()->count(500)->create();
    }
}
