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
        $start = $this->faker->dateTimeBetween('-2 year', '-1 year');
        $end = $this->faker->dateTimeBetween('-2 year', '-1 year');

        while (true) {
            if ($start >= $end) {
                break;
            }

            $end = $this->faker->dateTimeBetween('-2 year', '-1 year');
        }

        return [
            'verified' => random_int(0, 1),
            'reason' => $this->faker->sentence,
            'start_date' => $start,
            'end_date' => $end,
            'user_id' => random_int(1, 100),
        ];
    }
}
