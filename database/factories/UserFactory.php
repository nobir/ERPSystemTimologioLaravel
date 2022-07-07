<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Address;

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
            'type' => random_int(-1, 4),
            'status' => random_int(0, 1),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'salary' => $this->faker->randomFloat(2, 0, 100000),
            'hire_date' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'address_id' => $this->faker->unique()->numberBetween(101, 200),
            'station_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
