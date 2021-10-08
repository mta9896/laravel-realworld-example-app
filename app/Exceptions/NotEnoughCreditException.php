<?php


namespace App\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

class NotEnoughCreditException extends HttpException
{
    public function __construct($statusCode, $message = null, \Exception $previous = null, array $headers = [], $code = 0)
    {
        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }
}