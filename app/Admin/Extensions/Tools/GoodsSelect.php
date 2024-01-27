<?php

namespace App\Admin\Extensions\Tools;

use App\Models\Goods;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Widgets\Dropdown;

class GoodsSelect extends AbstractTool
{

    public function render()
    {

        $goods = Goods::pluck('name', 'id')->toArray();
        $dropdown = Dropdown::make($goods)
            ->button('+新增') // 设置按钮
            ->buttonClass('btn btn-primary  waves-effect') // 设置按钮样式
            ->map(function ($label, $key) {
                // 格式化菜单选项
                $url = admin_url('/order/create?goods_id='.$key);

                return "<a href='$url'>{$label}</a>";
            });

        return $dropdown;
    }

}
