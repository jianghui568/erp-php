<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use App\Models\Order;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function test() {
        $goods = Order::find(7);

//        $goods->goods_info = [['sku' => 'aa', 'num' => 1]];
        dd($goods->toArray());
        $goods->save();
        return $goods;
    }
}
