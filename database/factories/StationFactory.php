<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class StationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'type' => random_int(0, 2),
            'address_id' => $this->faker->unique()->numberBetween(1, 100),
        ];
    }
}
