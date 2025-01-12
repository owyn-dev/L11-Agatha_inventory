<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            'full_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'username' => $this->faker->unique()->userName(),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }

    public function withRandomRole(array $availableRoles): Factory {
        return $this->afterCreating(function (User $user) use ($availableRoles) {
            // Pilih random role dari daftar
            $randomRole = $this->faker->randomElement($availableRoles);

            // Pastikan role ada di database
            Role::firstOrCreate(['name' => $randomRole]);

            // Berikan role ke user
            $user->assignRole($randomRole);
        });
    }
}
