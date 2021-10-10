<?php


namespace App\Services\Credit;


use App\Constants\Credit;

class CommentCreditDecrease extends DecreaseCredit
{

    protected function shouldCreditBeReduced()
    {
        return $this->user->comments()->count() > Credit::FREE_COMMENT_COUNT_LIMIT;
    }

    protected function getCreditReductionAmount()
    {
        return Credit::CREDIT_PER_COMMENT;
    }
}