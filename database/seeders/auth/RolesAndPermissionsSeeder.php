<?php

namespace Database\Seeders\auth;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Setup Data Permissions
        $permissions = [
            // Dashboard 0
            'view dashboard',
            // Priority Analysis 1
            'view_analysis_products_priority',
            // Manage Product 2
            'view_product',
            'show_product',
            'barcode_scanner_product',
            'create_product',
            'update_product',
            'delete_product',
            // Manage Production 8
            'view_production',
            'show_production',
            'create_production',
            'update_production',
            'delete_production',
            'report_production',
            // Manage Sales 14
            'view_sale',
            'show_sale',
            'create_sale',
            'report_sale',
            // Manage Inventory 18
            'view_inventory_in',
            'view_inventory_out',
            'report_inventory',
            // Manage User 21
            'view_user',
            'show_user',
            'create_user',
            'update_user',
            'delete_user',
        ];

        // Setup Roles Have Permissions
        $rolesWithPermissions = [
            'Administrator' => [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25],
            'Production' => [0, 1, 2, 3, 4, 8, 9, 11, 13, 22, 24],
            'Sales' => [0, 1, 2, 3, 4, 5, 6, 7, 14, 15, 16, 17, 22, 24],
            'Inventory' => [0, 1, 2, 3, 4, 8, 9, 10, 11, 12, 13, 18, 19, 20, 22, 24],
        ];

        // Create Data Permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Data Roles and Give Permissions
        foreach ($rolesWithPermissions as $roleName => $indices) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $assignedPermissions = array_intersect_key($permissions, array_flip($indices));
            $role->syncPermissions($assignedPermissions);
        }
    }
}
