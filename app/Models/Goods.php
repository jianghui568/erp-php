<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Goods extends BaseModel
{
    protected $casts = [
        'sku_info' => 'array'
    ];
    public function sku() {
        return $this->hasMany(GoodsSku::class, 'goods_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(GoodsCategory::class, 'category_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function getSkuDataForEdit() {
        $skuList = $this->sku;
        $attr = $this->sku_info['attrs'];
        $sku = [];
        foreach ($skuList as $item) {
            $skuItem = [];
            foreach ($attr as $name => $attrValues) {
                $skuItem[$name] = Arr::get($item->sku_meta, $name);
            }
            $skuItem['pic'] = $item->pic;
            $skuItem['stock'] = $item->stock;
            $skuItem['price'] = $item->purchase_price;
            $skuItem['retail'] = $item->retail_price;
            $sk[] = $skuItem;
        }

        return json_encode([
            'attrs' => $attr,
            'sku' => $sk
        ], JSON_UNESCAPED_UNICODE);
    }
}
