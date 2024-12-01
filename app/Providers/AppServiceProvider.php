<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Barryvdh\Debugbar\Facades\Debugbar as Debugbar;

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
        // Disable Debugbar in production
        if (app()->isProduction()) {
            Debugbar::disable();
        }

        Password::defaults(function () {
            $testingRules = Password::min(3);
            $rules = Password::min(8)->max(255)->letters()->mixedCase()->numbers()->symbols();
            return app()->isProduction() ? $rules : $testingRules;
        });
    }
}
