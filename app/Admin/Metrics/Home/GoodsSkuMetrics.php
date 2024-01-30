<?php

namespace App\Admin\Metrics\Home;

use App\Enum\OrderState;
use App\Models\AdminUser;
use App\Models\GoodsSku;
use App\Models\Order;
use Dcat\Admin\Widgets\Metrics\RadialBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GoodsSkuMetrics extends RadialBar
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $time = date('Y-m-d H:i:s');
        $this->title('截止到'.$time . '，商品SKU库存数据');
        $this->height(180);

        $numArray = [
            10,20,30,50,100,300,500
        ];
        $options = [];
        foreach ($numArray as $num) {
            $options[$num] = $num;
        }
        $this->dropdown($options);
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        $num = $request->input('option');
        $this->withContent($num);
    }

    /**
     * 卡片内容
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($num)
    {

        $num = $num??10;
       $skus = GoodsSku::with('goods')
           ->where('stock','<', $num)
           ->orderBy('stock', 'asc')
           ->get();

       $goodsArray = [];
       $skuArray = [];
        foreach ($skus as $sku) {
            $goodsArray[$sku->goods->id] = $sku->goods->id;
            $skuArray[$sku->sku] = $sku->sku;
        }

        $goodsNum = count($goodsArray);
        $skuNum = count($skuArray);

        return $this->footer(
            <<<HTML
<div class="d-flex justify-content-between p-1" style="padding-top: 0!important;">
    <div class="text-center">
        <p>商品数</p>
           <span class="font-lg-1">{$goodsNum}</span>
    </div>
    <div class="text-center">
        <p>商品SKU</p>
        <a class="font-lg-1" href="/admin/goods/skuStockList?stock={$num}" target="_blank">{$skuNum}</a>
    </div>
</div>
HTML
        );
    }
}
