<?php


namespace App\Providers;


use App\Services\Notification\NotifyUserInterface;
use App\Services\Notification\SendEmail;
use Illuminate\Support\ServiceProvider;

class UserNotificationServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(NotifyUserInterface::class, SendEmail::class);
    }

}