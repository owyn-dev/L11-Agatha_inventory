<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\auth\RolesAndPermissionsSeeder;
use Database\Seeders\auth\UsersRolesSeeder;
use Database\Seeders\product\ProductsSeeder;
use Database\Seeders\production\ProductionsSeeder;
use Database\Seeders\sale\SalesSeeder;
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

        // Generate Data Products
        $this->call(ProductsSeeder::class);

        // Generate Data Productions
        $this->call(ProductionsSeeder::class);

        // Generate Data Sales
        $this->call(SalesSeeder::class);
    }
}
