<?php


namespace App\Services\Credit;


use App\Constants\Credit;
use App\User;

class ArticleCreditDecrease extends DecreaseCredit
{
    protected function shouldCreditBeReduced()
    {
        return true;
    }

    protected function getCreditReductionAmount()
    {
        return Credit::CREDIT_PER_ARTICLE;
    }
}