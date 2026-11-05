<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Override Chatify's Pusher messenger with Socket.IO (registered after package providers).
        $this->app->bind('ChatifyMessenger', function () {
            return new \App\Services\SocketChatifyMessenger();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Carbon::setLocale('pt_BR');
    }
}