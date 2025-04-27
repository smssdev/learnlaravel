<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\image;
use App\Models\item;
use App\Models\order;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create(); // ✅ Create an instance of Faker

         // إنشاء الأدوار
         $adminRole = Role::create(['name' => 'admin']);
         $waiterRole = Role::create(['name' => 'waiter']);
         $customerRole = Role::create(['name' => 'customer']);

         // إنشاء مستخدم Admin
         $admin = User::factory()->create([
             'name' => 'Admin User',
             'email' => 'admin@example.com',
         ]);
         $admin->assignRole('admin');
         $admin->profile()->create(['phone' => '1234567890', 'address' => 'Admin Address']);

         // إنشاء مستخدمين آخرين
         $waiter = User::factory()->create([
             'name' => 'Waiter User',
             'email' => 'waiter@example.com',
         ]);
         $waiter->assignRole('waiter');
         $waiter->profile()->create(['phone' => '0987654321', 'address' => 'Waiter Address']);

         // إنشاء عملاء
         $customers = User::factory(10)->create();
         foreach ($customers as $customer) {
             $customer->assignRole('customer');
             $customer->profile()->create([
                 'phone' => $faker->phoneNumber(),
                 'address' => $faker->address(),
             ]);
         }

         // إنشاء فئات
         $categories = category::factory(5)->create();

         // إنشاء أصناف
         $items = item::factory(20)->create();

         // إنشاء صور للأصناف (محاكاة مسارات الصور)
         foreach ($items as $item) {
             image::create([
                 'path' => 'items/' . $faker->uuid . '.jpg',
                 'imageable_id' => $item->id,
                 'imageable_type' => Item::class,
             ]);
         }

         // إنشاء طلبات
         $orders = order::factory(50)->create();
         foreach ($orders as $order) {
             $order->items()->attach(
                 $items->random(rand(1, 5))->pluck('id')->toArray(),
                 [
                     'quantity' => rand(1, 3),
                     'price' => $faker->randomFloat(2, 5, 50),
                 ]
             );
         }
    }
}
