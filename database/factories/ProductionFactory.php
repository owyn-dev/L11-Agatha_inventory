<?php

namespace Database\Factories;

use App\Models\Production;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Production::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'inventory_user_id' => User::factory(),
            'production_request_date' => $this->faker->dateTime(),
            'production_user_id' => User::factory(),
            'production_date' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['waiting_for_response', 'in_progress', 'pending_approval', 'approval', 'rejected']),
            'note' => $this->faker->word(),
        ];
    }
}
