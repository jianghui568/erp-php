<?php

namespace App\Models;

use Illuminate\Support\Arr;

class GoodsSku extends BaseModel
{
    protected $casts = [
        'sku_meta' => 'array',
    ];

    public function goods() {
        return $this->belongsTo(Goods::class, 'goods_id', 'id');
    }

    //  {"颜色":"绿","款式":"2格","pic":"","stock":"100","price":"20.8","retail":"5"}
    public static function verifySkuItem($item) {
        $fieldMap = [
            'stock' => '库存',
            'retail' => '零售价',
        ];
        foreach ($item as $field => $val) {
            if ($field == 'pic' || $field == 'stock'|| $field == 'price') {
                continue;
            }

            if (!$val) {
                $res = Arr::get($fieldMap, $field);
                $res = $res??$field;
                return $res . '必填';
            }
        }
    }

    public static function getSkuDataForGoodsEdit($goodsId) {
        $skus = GoodsSku::where('goods_id', $goodsId)->get();
        $data =[];

        foreach ($skus as $item) {
            $data[] = [
                'SKU' => $item->sku,
                'stock' => $item->stock,
                'pic' => $item->pic,
                'unit' => $item->unit,
                'price' => $item->purchase_money,
                'commodity_money' => $item->commodity_money,
            ];
        }
        return $data;
    }
}
