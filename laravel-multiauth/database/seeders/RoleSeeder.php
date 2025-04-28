<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $permissions = ['manage users', 'edit posts', 'delete posts'];
        foreach ($permissions as $perm) {
            Permission::create(['name' => $perm]);
        }

        $adminRole->givePermissionTo(Permission::all());
        $userRole->givePermissionTo(['edit posts']);




    }
}
