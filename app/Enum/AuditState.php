<?php

namespace App\Enum;

enum AuditState
{
    const SUCCESS = 1; // 成功
    const FAILED = 2; // 失败
    const PENDING = 3; // 待审核

    public static function asArray() {
        return [
            self::PENDING => '待审核',
            self::SUCCESS => '通过',
            self::FAILED => '拒绝',
        ];
    }
}
