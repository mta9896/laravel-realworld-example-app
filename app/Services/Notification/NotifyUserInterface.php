<?php


namespace App\Services\Notification;


use App\User;

interface NotifyUserInterface
{
    public function notify(User $user);
}