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
        $region_id = (random_int(1, 20) == 7 | random_int(1, 20) == 9 | random_int(1, 20) == 13 | random_int(1, 20) == 19) ? $this->faker->numberBetween(1, 10) : null;
        $branch_id = $this->faker->numberBetween(1, 50);

        if ($region_id != null) {
            $branch_id = null;
        } else {
            $region_id = null;
        }

        return [
            'verified' => random_int(0, 1),
            'verify_email' => -1,
            'username' => $this->faker->unique()->userName(),
            'type' => random_int(0, 4),
            'status' => random_int(0, 1),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Crypt::encrypt('password'),
            'salary' => $this->faker->randomFloat(2, 10000, 100000),
            'hire_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'address_id' => $this->faker->unique()->numberBetween(61, 160),
            'region_id' => $region_id,
            'branch_id' => $branch_id,
        ];
    }
}
