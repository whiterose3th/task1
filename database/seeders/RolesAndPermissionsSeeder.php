<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);

        $adminRole->givePermissionTo('manage users');
        $adminRole->givePermissionTo('edit articles');
        $adminRole->givePermissionTo('delete articles');

        $userRole->givePermissionTo('edit articles');
    }
}
