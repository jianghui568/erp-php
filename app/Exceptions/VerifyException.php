<?php

namespace App\Exceptions;

class VerifyException extends \RuntimeException
{
    public static function throwException($message)
    {
        $e = new VerifyException($message);
        throw  $e;
    }
}
