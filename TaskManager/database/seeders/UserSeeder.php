<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'slieman',
                'email' => 's@s.com',
                'password' => bcrypt('secret123')
            ],
            [
                'name' => 'ahmed',
                'email' => 'a@a.com',
                'password' => bcrypt('secret234')
            ],
            [
                'name' => 'rami',
                'email' => 'r@r.com',
                'password' => bcrypt('secret567')
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        };
    }
}
