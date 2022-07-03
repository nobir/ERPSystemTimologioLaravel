<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryInvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 'category_id'
        // 'invoice_id'
        return [
            'category_id' => $this->faker->numberBetween(1, 50),
            'invoice_id' => $this->faker->numberBetween(1, 2000),
        ];
    }
}
