<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'issue_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'receive_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'bonus' => $this->faker->randomFloat(2, 0, 100),
            'user_id' => random_int(1, 100),
        ];
    }
}
