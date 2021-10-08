<?php


namespace App\Services\Notification;


use App\Constants\Credit;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendEmail implements NotifyUserInterface
{

    public function notify(User $user)
    {
        $toAddress = $user->email;
        $toName = $user->username;

        $data = [
            'userName' => $user->username,
            'creditLimit' => Credit::NOTIFY_USER_CREDIT_THRESHOLD,
        ];

        try {
            Mail::send('emails.mail', $data, function ($message) use ($toName, $toAddress) {
                $message->to($toAddress, $toName)
                    ->subject('Credit Notice');
            });
        } catch (\Exception $exception) {
            Log::error("Error while sending email to user id $user->id");
        }
    }
}