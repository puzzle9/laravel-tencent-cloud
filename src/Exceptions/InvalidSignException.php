<?php


namespace Puzzle9\TencentCloudSdk\Exceptions;


class InvalidSignException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message, self::INVALID_SIGN);
    }
}