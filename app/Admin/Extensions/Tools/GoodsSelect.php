<?php

namespace App\Admin\Extensions\Tools;

use App\Models\Goods;
use Dcat\Admin\Grid\Tools\AbstractTool;
use Dcat\Admin\Widgets\Dropdown;

class GoodsSelect extends AbstractTool
{
    protected $uriPrefix = null;

    public function setUriPrefix($uriPrefix) {
        $this->uriPrefix = $uriPrefix;
        return $this;
    }

    public function render()
    {

        $uriPrefix =  $this->uriPrefix ?? 'order';
        $goods = Goods::pluck('name', 'id')->toArray();
        $dropdown = Dropdown::make($goods)
            ->button('+新增') // 设置按钮
            ->buttonClass('btn btn-primary  waves-effect') // 设置按钮样式
            ->map(function ($label, $key) use ($uriPrefix) {
                // 格式化菜单选项
                $url = admin_url('/'.$uriPrefix.'/create?goods_id='.$key);

                return "<a href='$url'>{$label}</a>";
            });

        return $dropdown;
    }

}
