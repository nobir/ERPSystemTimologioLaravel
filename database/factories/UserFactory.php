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
        $type_id = random_int(0, 4);
        $region_id = null;
        $branch_id = null;

        if ($type_id <= 1) {
            $region_id = null;
            $branch_id = null;
        } elseif ($type_id == 2) {
            $region_id = random_int(1, 10);
        } elseif ($type_id >= 3) {
            $branch_id = random_int(1, 50);
        } else {
            $region_id = null;
            $branch_id = null;
        }


        return [
            'verified' => random_int(0, 1),
            'verify_email' => -1,
            'username' => $this->faker->unique()->userName(),
            'type' => $type_id,
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
