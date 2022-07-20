<?php

namespace Database\Seeders;

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
            RegionSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,
            InventorySeeder::class,
            InvoiceSeeder::class,
            PaymentSeeder::class,
            PermissionSeeder::class,
            VacationDetailSeeder::class,
            WorkingHourSeeder::class,
            WorkPostSeeder::class,
            CategoryInvoiceSeeder::class,
            PermissionUserSeeder::class
        ]);
    }
}
