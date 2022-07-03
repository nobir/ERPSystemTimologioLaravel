<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VacationDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reason' => $this->faker->sentence,
            'start_date' => $this->faker->dateTimeBetween('-2 year', '-1 year'),
            'end_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => random_int(1, 100),
        ];
    }
}
