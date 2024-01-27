<?php
/**
 * @createtime   2023/4/5
 * @author       wild
 * @copyright    PhpStorm
 */


namespace App\Utils;


use App\Exceptions\JingCaiException;

class ThrowException
{
    public static function isTrue($condition, $message, $code=Result::FAILED)
    {
        if ($condition) {
            ThrowException::run($message, $code);
        }
    }

    public static function run($message, $code=Result::FAILED)
    {
        JingCaiException::throwJingcai($message, $code);
    }
}
