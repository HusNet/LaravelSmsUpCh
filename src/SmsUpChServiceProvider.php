<?php

namespace Husnet\LaravelSmsUpCh;

use Illuminate\Notifications\ChannelManager;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

/**
 * Class SmsUpChServiceProvider
 * @package Husnet\LaravelSmsUpCh
 */
class SmsUpChServiceProvider extends ServiceProvider
{
    /**
     * Register.
     */
    public function register()
    {
        Notification::resolved(function (ChannelManager $service) {
            $service->extend('smsUpCh', function () {
                return new SmsUpChChannel();
            });
        });
        $this->app->bind('smsUpCh', function() {
            return new SmsUpChManager(config('services.smsUpCh'));
        });

        $this->registerRoutes();
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {

    }

    /**
     * Get the SmsUp route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'domain' => null,
            'namespace' => 'Husnet\LaravelSmsUpCh\Http\Controllers',
            'prefix' => 'smsupch'
        ];
    }
}