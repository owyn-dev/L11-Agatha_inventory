<?php

namespace Database\Factories;

use App\Models\InventoryIn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryInFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryIn::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'batch_code' => $this->faker->word(),
            'transaction_date' => $this->faker->dateTime(),
            'shelf_name' => $this->faker->word(),
            'stock_start' => $this->faker->numberBetween(-10000, 10000),
            'current_stock' => $this->faker->numberBetween(-10000, 10000),
            'unit_price' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'expiration_date' => $this->faker->dateTime(),
        ];
    }
}
