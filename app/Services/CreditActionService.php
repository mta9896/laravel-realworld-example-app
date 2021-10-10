<?php


namespace App\Services;

use App\Constants\Credit;
use App\Services\Notification\NotifyUserInterface;
use App\User;
use Carbon\Carbon;

class CreditActionService
{
    private $notifyUser;

    public function __construct(NotifyUserInterface $notifyUser)
    {
        $this->notifyUser = $notifyUser;
    }

    public function handleCreditUpdateActions(User $user, int $primaryCredit, int $updatedCredit)
    {
        if ($updatedCredit > Credit::NOTIFY_USER_CREDIT_THRESHOLD) {
            return;
        }

        if ($primaryCredit > Credit::NOTIFY_USER_CREDIT_THRESHOLD && $updatedCredit <= Credit::NOTIFY_USER_CREDIT_THRESHOLD) {
            $this->notifyUser->notify($user);
        } elseif ($primaryCredit > Credit::BAN_USER_CREDIT_THRESHOLD && $updatedCredit <= Credit::BAN_USER_CREDIT_THRESHOLD) {
            $this->deactivateUser($user);
        }
    }

    private function deactivateUser(User $user)
    {
        $user->deactivated_at = Carbon::now();
        $user->save();
    }
}