<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'phone' => '1234567890',
                'status' => 'active',
                'job_title' => 'System Administrator',
                'restaurant_id' => null, // الأدمن لا ينتمي لمطعم معين
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pizza Manager',
                'email' => 'manager@pizzapalace.com',
                'password' => Hash::make('password123'),
                'phone' => '0987654321',
                'status' => 'active',
                'job_title' => 'Restaurant Manager',
                'restaurant_id' => 1, // Pizza Palace
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sushi Staff',
                'email' => 'staff@sushihaven.com',
                'password' => Hash::make('password123'),
                'phone' => '1122334455',
                'status' => 'active',
                'job_title' => 'Waiter',
                'restaurant_id' => 2, // Sushi Haven
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            // تعيين الأدوار (يتم بعدها في RolePermissionSeeder)
        }
    }
}
