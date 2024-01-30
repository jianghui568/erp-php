<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Entry extends BaseModel
{
    protected $casts = [
        'goods_info' => 'array',
    ];

    public function goods() {
        return $this->belongsTo(Goods::class, 'goods_id', 'id');
    }

    public function admin() {
        return $this->belongsTo(AdminUser::class, 'admin_id', 'id');
    }

    public function skus() {
        return $this->hasMany(EntrySku::class, 'entry_id', 'id');
    }


    public function getGoodsInfoAttribute($goodsInfo)
    {
        return is_array($goodsInfo) ? $goodsInfo : json_decode($goodsInfo, true);
    }

    public function getOrderSkuString() {
        $sku = [];
        foreach ($this->skus as $item) {
            $sku[] = $item->sku . ':' . $item->num ;
        }
        return implode( "\r\n",$sku);
    }
}
