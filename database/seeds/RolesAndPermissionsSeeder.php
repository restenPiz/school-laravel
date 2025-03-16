<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'edit articles']);

        $role = Role::create(['name' => 'Admin']);
        $role = Role::create(['name' => 'Teacher']);
        $role = Role::create(['name' => 'Parent']);
        $role = Role::create(['name' => 'Student']);

        // $role->givePermissionTo('edit articles');
    }
}
