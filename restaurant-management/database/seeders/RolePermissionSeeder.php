<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء الصلاحيات
        $permissions = [
            'view users', 'create users', 'edit users', 'delete users',
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view restaurants', 'create restaurants', 'edit restaurants', 'delete restaurants',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // إنشاء الأدوار
        $adminRole = Role::create(['name' => 'admin']);
        $managerRole = Role::create(['name' => 'manager']);
        $staffRole = Role::create(['name' => 'staff']);

        // تعيين الصلاحيات للأدوار
        $adminRole->givePermissionTo($permissions);
        $managerRole->givePermissionTo([
            'view users', 'create users', 'edit users',
            'view restaurants', 'edit restaurants',
        ]);
        $staffRole->givePermissionTo(['view users', 'view restaurants']);

        // تعيين الأدوار للمستخدمين
        $admin = User::where('email', 'admin@example.com')->first();
        $manager = User::where('email', 'manager@pizzapalace.com')->first();
        $staff = User::where('email', 'staff@sushihaven.com')->first();

        if ($admin) {
            $admin->assignRole('admin');
        }
        if ($manager) {
            $manager->assignRole('manager');
        }
        if ($staff) {
            $staff->assignRole('staff');
        }
    }
}
