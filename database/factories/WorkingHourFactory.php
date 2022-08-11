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
        $entry = $this->faker->time();
        $exit = $this->faker->time();

        while (true) {
            if ($entry >= $exit) {
                break;
            }

            $exit = $this->faker->time();
        }

        return [
            'date' => $this->faker->dateTimeBetween('-2 year', 'now'),
            'entry_time' => $entry,
            'exit_time' => $exit,
            'user_id' => random_int(1, 100),
        ];
    }
}
