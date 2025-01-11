<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'image' => $this->faker->word(),
            'variant' => $this->faker->randomElement(["tabung_s","tabung_m","kotak"]),
            'price' => $this->faker->randomFloat(2, 0, 9999999999999.99),
            'expired_day' => $this->faker->numberBetween(-10000, 10000),
            'stock' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
