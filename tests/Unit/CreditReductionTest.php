<?php

namespace Tests\Unit;

use App\Services\Notification\NotifyUserInterface;
use Mockery\MockInterface;
use Tests\TestCase;

class CreditReductionTest extends TestCase
{
    public function testEmailIsSentWhenUpdatedCreditIsEqualTo20()
    {
        $this->instance(NotifyUserInterface::class, \Mockery::mock(NotifyUserInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('notify')
                ->once();
        }));
        $creditAction = $this->app->make('App\Services\CreditActionService');


        $user = \Mockery::mock('App\User');
        $creditAction->handleCreditUpdateActions($user, 25000, 20000);
    }

    public function testEmailIsSentWhenUpdatedCreditIsBelow20()
    {
        $this->instance(NotifyUserInterface::class, \Mockery::mock(NotifyUserInterface::class, function (MockInterface $mock) {
            $mock->shouldReceive('notify')
                ->once();
        }));
        $creditAction = $this->app->make('App\Services\CreditActionService');


        $user = \Mockery::mock('App\User');
        $creditAction->handleCreditUpdateActions($user, 24000, 19000);
    }

    public function testEmailIsNotSentWhenCreditIsAlreadyUnder20()
    {
        $this->instance(NotifyUserInterface::class, \Mockery::mock(NotifyUserInterface::class, function (MockInterface $mock) {
            $mock->shouldNotReceive('notify');
        }));
        $creditAction = $this->app->make('App\Services\CreditActionService');


        $user = \Mockery::mock('App\User');
        $creditAction->handleCreditUpdateActions($user, 20000, 15000);
    }

    public function testEmailIsNotSentAndUserIsNotBannedWhenCreditAboveThreshold()
    {
        $this->instance(NotifyUserInterface::class, \Mockery::mock(NotifyUserInterface::class, function (MockInterface $mock) {
            $mock->shouldNotReceive('notify');
        }));
        $creditAction = $this->app->make('App\Services\CreditActionService');
        $user = \Mockery::spy('App\User');

        $creditAction->handleCreditUpdateActions($user, 30000, 25000);

        $user->shouldNotReceive('setAttribute')->with('deactivated_at');
        $user->shouldNotReceive('save');

    }

    public function testUserIsDeactivatedWhenCreditUnderZero()
    {
        $creditAction = $this->app->make('App\Services\CreditActionService');
        $user = \Mockery::spy('App\User');

        $creditAction->handleCreditUpdateActions($user, 4000, -1000);

        $user->shouldReceive('setAttribute')->with('deactivated_at');
        $user->shouldReceive('save');
    }
}
