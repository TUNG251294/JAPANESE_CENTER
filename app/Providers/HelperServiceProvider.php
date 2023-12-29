<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $file = app_path('Helpers/helper.php');
        if (file_exists($file)) {
            require_once($file);
        }
        // foreach (glob(app_path() . '/Helpers/*.php') as $file) {
        //     require_once($file);
        // }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
