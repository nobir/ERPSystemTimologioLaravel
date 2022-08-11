<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => random_int(1, 100),
            'branch_id' => random_int(1, 50),
            'category_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
