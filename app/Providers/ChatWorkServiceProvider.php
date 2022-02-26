<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChatWorkServiceProvider extends ServiceProvider {
    public function register()
    {
        $this->app->bind(
            'chatworkapi',
            'App\Services\ChatworkService'
        );
    }
}