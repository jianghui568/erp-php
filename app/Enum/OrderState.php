<?php

namespace App\Enum;

enum OrderState
{
    const PAID = 1; // 支付，未发货
    const SHIPPED = 2; // 已发货
    const RETURN = 3; // 退货退款

    public static function asArray() {
        return [
            self::PAID => '未发货',
            self::SHIPPED => '已发货',
            self::RETURN => '退货退款',
        ];
    }
}
