<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-2 year', 'now'),
            'entry_time' => $this->faker->time,
            'exit_time' => $this->faker->time,
            'user_id' => random_int(1, 100),
        ];
    }
}
