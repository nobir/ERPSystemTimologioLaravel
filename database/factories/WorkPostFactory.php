<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'joining_date' => $this->faker->dateTimeBetween('-3 year', '-1 year'),
            'leave_date' => random_int(0, 50) != 10 ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
            'user_id' => random_int(1, 100),
            'station_id' => random_int(1, 100),
        ];
    }
}
