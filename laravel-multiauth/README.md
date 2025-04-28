# lesson1 

composer create-project laravel/laravel laravel-multiauth-vue
cd laravel-multiauth-vue

composer require laravel/jetstream
php artisan jetstream:install inertia
npm install && npm run dev
php artisan migrate

==========================

Jetstream بيعطيك:

تسجيل دخول/تسجيل

تأكيد البريد

صفحة المستخدمين

تنقل (Navigation) جاهز
==============================

composer require spatie/laravel-permission
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
php artisan migrate
=================================

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;
    ...
}
==================

php artisan make:seeder RoleSeeder
=============================

php artisan db:seed --class=RoleSeeder

=======================================

