<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage menu',      // Menu Management: add/edit/delete categories & products
            'view reports',     // Reports
            'manage users',     // Users: create/edit/assign roles
        ];

        // --- POS ORDER PERMISSIONS ---
        $cashierPermissions = [
            'access pos', // POS register 
            'process payment', // Payment Processing
            'view order status', // Order Status
        ];

        foreach (array_merge($permissions, $cashierPermissions) as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(array_merge($permissions, $cashierPermissions));

        $cashierRole = Role::firstOrCreate(['name' => 'cashier']);
        $cashierRole->givePermissionTo($cashierPermissions);


    }
}
