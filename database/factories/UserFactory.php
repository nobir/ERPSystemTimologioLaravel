<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'verified' => random_int(0, 1),
            'verify_email' => -1,
            'username' => $this->faker->unique()->userName(),
            'type' => random_int(0, 4),
            'status' => random_int(0, 1),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Crypt::encrypt('password'),
            'salary' => $this->faker->randomFloat(2, 0, 100000),
            'hire_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'address_id' => $this->faker->unique()->numberBetween(101, 200),
            'station_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
