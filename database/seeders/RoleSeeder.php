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
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'coordinator']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'users.index'])->assignRole($role1);
        Permission::create(['name' => 'users.edit'])->assignRole($role1);
        Permission::create(['name' => 'users.destroy'])->assignRole($role1);
    }
}
