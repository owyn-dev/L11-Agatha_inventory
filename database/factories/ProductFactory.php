<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'image' => 'cheese_sagoo.jpg',
            'variant' => $this->faker->randomElement(['tabung_s', 'tabung_m', 'kotak']),
            'price' => $this->faker->randomFloat(2, 50000, 150000),
            'expired_day' => $this->faker->numberBetween(1, 30),
            'stock' => 0,
        ];
    }
}
