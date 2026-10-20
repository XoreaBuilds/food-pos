<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CashierPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'access pos',
            'process payments',
            'view order status',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $cashierRole = Role::firstOrCreate(['name' => 'cashier']);
        $cashierRole->givePermissionTo($permissions);

        // Admin should also be able to do everything a cashier can
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);
    }
}