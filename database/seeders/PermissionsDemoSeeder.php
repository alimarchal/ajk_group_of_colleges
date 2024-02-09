<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;

class PermissionsDemoSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions (CRUD)
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);


        // create roles and assign existing permissions
        $role3 = Role::create(['name' => 'Super-Admin']);
        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('delete');
        $role2->givePermissionTo('create');
        $role2->givePermissionTo('edit');


        $user = \App\Models\User::factory()->create([
            'name' => 'Ali Raza Marchal',
            'username' => 'Super-Admin',
            'email' => 'kh.marchal@gmail.com',
            'password' => Hash::make('123456')
        ]);
        $user->assignRole($role3);


        $user = \App\Models\User::factory()->create([
            'name' => 'Example Admin User',
            'username' => 'admin',
            'email' => 'admin@ajkgc.com',
            'password' => Hash::make('123456')
        ]);
        $user->assignRole($role2);

        Role::create(['name' => 'accountant']);
        Role::create(['name' => 'parent']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'receptionist']);
        Role::create(['name' => 'student']);

        //php artisan migrate:fresh --seed --seeder=PermissionsDemoSeeder
    }
}
