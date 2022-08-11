<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name() . " Branch",
            'region_id' => $this->faker->numberBetween(1, 10), // random_int(1, 10),
            'address_id' => $this->faker->unique()->numberBetween(11, 60), //random_int(11, 100),
        ];
    }
}
