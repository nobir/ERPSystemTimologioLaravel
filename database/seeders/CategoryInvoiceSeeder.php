<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryInvoice;

class CategoryInvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryInvoice::factory()->count(1000)->create();
    }
}
