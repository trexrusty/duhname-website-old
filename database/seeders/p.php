<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class p extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Reset cached roles and permissions
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

                // create permissions
                Permission::create(['name' => 'edit articles']);
                Permission::create(['name' => 'delete articles']);
                Permission::create(['name' => 'publish articles']);
                Permission::create(['name' => 'unpublish articles']);

                // update cache to know about the newly created permissions (required if using WithoutModelEvents in seeders)
                app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


                // create roles and assign created permissions

                // this can be done as separate statements
                $role = Role::create(['name' => 'Verified']);
                $role->givePermissionTo('edit articles');

                // or may be done by chaining
                $role = Role::create(['name' => 'Bug Hunter']);

                $role = Role::create(['name' => 'super-admin']);
                $role->givePermissionTo(Permission::all());

    }
}
