<?php

namespace App\Models;

class SkuLog extends BaseModel
{
    public function goods() {
        return $this->belongsTo(Goods::class, 'goods_id', 'id');
    }

    public function admin() {
        return $this->belongsTo(AdminUser::class,'admin_id', 'id');
    }

    public static function reduceLog( $adminId, OrderSku $orderSku ,GoodsSku $goodsSkuBegin)
    {
        $goodsSku = GoodsSku::where('goods_id', $goodsSkuBegin->goods_id)
            ->where('sku', $orderSku->sku)
            ->first();
        $log = new SkuLog();
        $log->admin_id = $adminId;
        $log->order_id = $orderSku->order_id;
        $log->goods_id = $goodsSkuBegin->goods_id;
        $log->goods_sku = $orderSku->sku;
        $log->action_sku_num = $orderSku->num;
        $log->action = '-';
        $log->sku_stock_begin = $goodsSkuBegin->stock;
        $log->sku_stock_end = $goodsSku->stock;
        $log->save();
    }
    public static function incrLog($adminId,EntrySku $entrySku,GoodsSku $goodsSkuBegin)
    {
        $goodsSku = GoodsSku::where('goods_id', $goodsSkuBegin->goods_id)
            ->where('sku', $entrySku->sku)
            ->first();
        $log = new SkuLog();
        $log->admin_id = $adminId;
        $log->entry_id = $entrySku->entry_id;
        $log->goods_id = $goodsSkuBegin->goods_id;
        $log->goods_sku = $entrySku->sku;
        $log->action_sku_num = $entrySku->num;
        $log->action = '+';
        $log->sku_stock_begin = $goodsSkuBegin->stock;
        $log->sku_stock_end = $goodsSku->stock;
        $log->save();
    }
}
