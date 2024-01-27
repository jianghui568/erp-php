<?php

namespace App\Models;

use Illuminate\Support\Arr;

class OrderSkuLog extends BaseModel
{
    public static function addLog($adminId, $orderId, $goodsId, $goodsSku, $actionNum, $action = '-')
    {
        $log = new OrderSkuLog();
        $log->admin_id = $adminId;
        $log->order_id = $orderId;
        $log->goods_id = $goodsId;
        $log->goods_sku = $goodsSku;
        $log->action_sku_num = $actionNum;
        $log->action = $action;
        $log->save();
    }
}
