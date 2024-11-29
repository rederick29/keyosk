<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Barryvdh\Debugbar\Facade as Debugbar;
use Illuminate\Validation\Rules\Password;

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
            $rules = Password::min(6)->letters()->mixedCase()->numbers()->symbols();
            return app()->isProduction() ? $rules : $testingRules;
        });
    }
}
