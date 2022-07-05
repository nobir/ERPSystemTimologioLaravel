<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'invoice_add' => random_int(0, 1),
            'invoice_manage' => random_int(0, 1),
            'inventory_manage' => random_int(0, 1),
            'category_manage' => random_int(0, 1),
            'station_manage' => random_int(0, 1),
            'operation_manage' => random_int(0, 1),
            'user_manage' => random_int(0, 1),
            'permission_mange' => random_int(0, 1),
            'user_id' => random_int(1, 100),
        ];
    }
}
