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
            'name' => $this->faker->name . " Branch",
            'region_id' => random_int(1, 10),
            'address_id' => random_int(11, 100),
        ];
    }
}
