<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use App\Models\Patient;
use App\Observers\PatientObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        // Register Patient observer to auto-create physical examinations
        Patient::observe(PatientObserver::class);
    }
}
