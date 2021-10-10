<?php


namespace App\Services\Strategy;


use App\User;

class ArticleCreditDecrease extends DecreaseCredit
{
    const CREDIT_PER_ARTICLE = 5000;

    protected function shouldCreditBeReduced()
    {
        return true;
    }

    protected function getCreditReductionAmount()
    {
        return self::CREDIT_PER_ARTICLE;
    }
}