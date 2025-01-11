<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DetailSales;
use App\Models\Product;
use App\Models\Sale;

class DetailSalesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailSales::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'sales_id' => Sale::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
            'price' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'sub_total' => $this->faker->randomFloat(2, 0, 9999999999999.99),
        ];
    }
}
