<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\DetailProduction;
use App\Models\Product;
use App\Models\Production;

class DetailProductionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailProduction::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'production_id' => Production::factory(),
            'product_id' => Product::factory(),
            'batch_code' => $this->faker->word(),
            'expiration_date' => $this->faker->dateTime(),
            'shelf_name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
