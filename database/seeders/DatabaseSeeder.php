<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\auth\RolesAndPermissionsSeeder;
use Database\Seeders\auth\UsersRolesSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Generate Data Roles And Permissions
        $this->call(RolesAndPermissionsSeeder::class);

        // Generate Data Users
        $this->call(UsersRolesSeeder::class);
    }
}
