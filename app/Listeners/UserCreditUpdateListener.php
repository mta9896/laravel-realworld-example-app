<?php

namespace App\Listeners;

use App\Events\UserCreditLessThanNotifyLimit;
use App\Events\UserCreditUpdated;
use App\Services\CreditActionService;
use App\Services\Notification\NotifyUserInterface;
use Illuminate\Support\Facades\Log;

class UserCreditUpdateListener
{
    /**
     * @var CreditActionService
     */
    private $creditActionService;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CreditActionService $creditActionService)
    {
        $this->creditActionService = $creditActionService;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreditUpdated  $event
     * @return void
     */
    public function handle(UserCreditUpdated $event)
    {
        Log::info($event->getPrimaryCredit());
        Log::info($event->getUpdatedCredit());
        $this->creditActionService->handleCreditUpdateActions($event->getUser(), $event->getPrimaryCredit(), $event->getUpdatedCredit());
    }
}