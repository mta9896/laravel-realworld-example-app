<?php


namespace App\Constants;

/**
 * Class Credit
 */
class Credit
{
    const PRIMARY_CREDIT = 100000;

    const CREDIT_PER_ARTICLE = 5000;

    const CREDIT_PER_COMMENT = 5000;

    const FREE_COMMENTS_COUNT_THRESHOLD = 5;

    const NOTIFY_USER_CREDIT_THRESHOLD = 20000;

    const BAN_USER_CREDIT_THRESHOLD = 0;

    const DELETE_USER_ACCOUNT_AFTER_HOURS = 24;
}