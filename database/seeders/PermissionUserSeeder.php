<?php

namespace Database\Seeders;

use App\Models\PermissionUser;
use Illuminate\Database\Seeder;

class PermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionUser::factory()->count(100)->create();
    }
}
