<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class KitchenPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view kitchen display',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $kitchenRole = Role::firstOrCreate(['name' => 'kitchen']);
        $kitchenRole->syncPermissions($permissions);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);
    }
}
