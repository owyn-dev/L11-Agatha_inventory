<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

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
