<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
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
            'details' => $this->faker->text,
            // 'size' => $this->faker->randomDigit(2, 0, 100),
            'cost_price' => $this->faker->randomFloat(2, 0, 100000),
            'sell_price' => $this->faker->randomFloat(2, 0, 100000),
            'discount' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
