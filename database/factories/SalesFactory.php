<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Sales;
use App\Models\User;

class SalesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sales::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'sales_user_id' => User::factory(),
            'transaction_date' => $this->faker->dateTime(),
            'total_amount' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
