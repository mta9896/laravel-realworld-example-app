<?php


namespace App\Services\Credit;


use App\Exceptions\NotEnoughCreditException;
use App\Invoice;
use App\User;

abstract class DecreaseCredit
{
    /**
     * @var User
     */
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function handleUserCreditReduction()
    {
        if ($this->shouldCreditBeReduced()) {
            $this->user->credit -= $this->getCreditReductionAmount();
            $this->user->save();

            $this->createNewInvoice();
        }
    }

    abstract protected function shouldCreditBeReduced();

    abstract protected function getCreditReductionAmount();

    private function createNewInvoice()
    {
        $this->user->invoices()->create([
            'amount' => $this->getCreditReductionAmount(),
        ]);
    }
}