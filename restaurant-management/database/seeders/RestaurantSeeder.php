<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            [
                'name' => 'Pizza Palace',
                'address' => '123 Main Street, City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sushi Haven',
                'address' => '456 Ocean Avenue, City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Burger Bonanza',
                'address' => '789 Food Lane, City',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Restaurant::insert($restaurants);
    }
}
