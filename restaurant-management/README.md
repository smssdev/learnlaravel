# composer create-project laravel/laravel restaurant-management "11.*"
# composer require laravel/sanctum



# php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"


'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],
    'api' => [
        'driver' => 'sanctum',
        'provider' => 'users',
    ],
],


$middleware->alias([
            'auth:sanctum' => \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);


# php artisan make:seeder RestaurantSeeder

# composer require spatie/laravel-permission
# php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

