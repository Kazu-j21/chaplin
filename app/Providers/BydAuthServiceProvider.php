<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BydAuthServiceProvider extends ServiceProvider {
    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(
            'bydAuth',
            'App\Services\BydAuthService'
        );
    }
}
