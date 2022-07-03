<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WorkPost;

class WorkPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkPost::factory()->count(100)->create();
    }
}
