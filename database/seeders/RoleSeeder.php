<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleCoordinator = Role::create(['name' => 'coordinator']);

        // Permisos comunes a ambos roles
        $permissionsCommon = [
            'dashboard'
        ];

        // Permisos exclusivos de admin
        $permissionsAdmin = [
            'users.index', 
            'users.edit', 
            'users.destroy'
        ];

        // Asignar permisos comunes
        foreach ($permissionsCommon as $permission) {
            Permission::create(['name' => $permission])->syncRoles([$roleAdmin, $roleCoordinator]);
        }

        // Asignar permisos específicos de admin
        foreach ($permissionsAdmin as $permission) {
            Permission::create(['name' => $permission])->assignRole($roleAdmin);
        }
    }

}
