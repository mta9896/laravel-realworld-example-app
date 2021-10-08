<?php


namespace App\Services\Strategy;


use App\User;

class CommentCreditDecrease extends DecreaseCredit
{

    const CREDIT_PER_COMMENT = 5000;

    protected function shouldCreditBeReduced()
    {
        return $this->user->comments()->count() > 5;
    }

    protected function getCreditReductionAmount()
    {
        return self::CREDIT_PER_COMMENT;
    }
}