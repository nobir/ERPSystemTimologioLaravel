<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'station_id' => random_int(1, 100),
            'customer_id' => random_int(1, 2000),
            'user_id' => random_int(1, 100),
        ];
    }
}
