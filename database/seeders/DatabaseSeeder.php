<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AddressSeeder::class,
            CategorySeeder::class,
            CustomerSeeder::class,
            UserSeeder::class,
            StationSeeder::class,
            // InventorySeeder::class,
            // InvoiceSeeder::class,
            // PaymentSeeder::class,
            // VacationDetailSeeder::class,
            // WorkingHourSeeder::class,
            // WorkPostSeeder::class,
            // CategoryInvoiceSeeder::class
        ]);
    }
}
