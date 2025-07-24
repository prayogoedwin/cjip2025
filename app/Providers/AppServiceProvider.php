<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        // This custom directive will check if the user is authenticated AND has the 'perusahaan' role.
        // This mirrors the logic you would have in an 'auth.investor' middleware.
        Blade::if('investor', function () {
            /** @var \App\Models\User|Authenticatable|null $user */
            $user = auth()->user();

            // The directive is false if no user is logged in or the user object is invalid.
            if (!$user) {
                return false;
            }
            return $user->hasRole('perusahaan');
        });

        Blade::if('admin', function () {
            /** @var \App\Models\User|Authenticatable|null $user */
            $user = auth()->user();
            return $user;
        });
    }
}
