<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Gate::define('is_admin', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('is_user', function (User $user) {
            return $user->role === 'user';
        });
    }
}
