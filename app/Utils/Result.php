<?php

namespace App\Utils;


class Result implements \JsonSerializable
{
    const SUCCESS = 200; // 成功
    const FAILED = 500; // 操作失败
    const UNAUTHORIZED = 401; // 暂未登录或token已经过期
    const FORBIDDEN = 403; // 没有相关权限
    const NOT_FOUND = 404; // 404
    const VALIDATE_FAILED = 410; // 参数检验失败


    private $code;
    private $data;
    private $message;

    public function __construct($code, $message, $data)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * @param $data
     * @param string $message
     * @return Result
     */
    public static function success($data, string $message = ''): Result
    {
        return new Result(self::SUCCESS, $message, $data);
    }

    /**
     * @param $message
     * @param int $code
     * @param $data
     * @return Result
     */
    public static function failed($message, int $code = self::FAILED, $data=null): Result
    {
        return new Result($code, $message, $data);
    }

    public function jsonSerialize() {
        return [
            'code' => $this->code,
            'message' => $this->message,
            'data' => $this->data,
        ];
    }
}
