<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //Get to check if user is admin
        Gate::define('admin', function ($user) {
            return $user->hasTeamRole($user->currentTeam(),'admin');
        });
    }
}
