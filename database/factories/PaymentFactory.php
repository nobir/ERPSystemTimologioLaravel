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
        $issue = $this->faker->dateTimeBetween('-1 year', 'now');
        $receive = $this->faker->dateTimeBetween('-1 year', 'now');

        while (true) {
            if ($issue >= $receive) {
                break;
            }

            $receive = $this->faker->dateTimeBetween('-1 year', 'now');
        }

        return [
            'issue_date' => $issue,
            'receive_date' => $receive,
            'bonus' => $this->faker->randomFloat(2, 0, 100),
            'user_id' => random_int(1, 100),
        ];
    }
}
