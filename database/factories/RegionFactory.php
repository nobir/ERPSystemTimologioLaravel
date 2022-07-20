<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name . " Region",
            'address_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
