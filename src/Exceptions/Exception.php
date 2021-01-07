<?php


namespace Puzzle9\TencentCloudSdk\Exceptions;


class Exception extends \Exception
{
    const INVALID_SIGN = 1;
    
    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }
}