<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\InventoryIn;
use App\Models\InventoryOut;

class InventoryOutFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InventoryOut::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inventory_in_id' => InventoryIn::factory(),
            'batch_code' => $this->faker->word(),
            'transaction_date' => $this->faker->dateTime(),
            'shelf_name' => $this->faker->word(),
            'stock_out' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
