<?php

namespace Database\Seeders\auth;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersRolesSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {

        // Setup Data Users
        $users = [
            ['full_name' => 'Administrator', 'username' => 'administrator', 'role' => 'Administrator'],
            ['full_name' => 'Production', 'username' => 'production', 'role' => 'Production'],
            ['full_name' => 'Sales', 'username' => 'sales', 'role' => 'Sales'],
            ['full_name' => 'Inventory', 'username' => 'inventory', 'role' => 'Inventory'],
        ];

        // Factory Data Users
        foreach ($users as $userData) {
            User::factory()->create([
                'full_name' => $userData['full_name'],
                'username' => $userData['username'],
            ])->assignRole($userData['role']);
        }

        // Factory Random Data Users
        $roles = ['Administrator', 'Production', 'Sales', 'Inventory'];
        User::factory()->count(10)->withRandomRole($roles)->create();
    }
}
