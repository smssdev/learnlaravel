<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share([
            'auth.user' => function () {
                $user = auth()->user();
                if ($user) {
                    return array_merge($user->only('id', 'name', 'email'), [
                        'roles' => $user->getRoleNames(),
                        'permissions' => $user->getPermissionNames(),
                    ]);
                }
                return null;
            },
        ]);
    }
}
