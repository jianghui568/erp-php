<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Forms\OrderForm;
use App\Admin\Extensions\Tools\GoodsSelect;
use App\Admin\Extensions\Tools\OrderStateRadio;
use App\Enum\OrderState;
use App\Models\AdminUser;
use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\GoodsSku;
use App\Models\Order;
use App\Models\OrderSku;
use App\Models\SkuLog;
use App\Models\Vendor;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class SkuLogController extends AdminController
{
    use AdminInfoTrait;

    protected $title = 'SKU日志';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(SkuLog::class, function (Grid $grid) {
            $grid->model()->with(['goods', 'admin'])
                ->orderBy('id', 'desc');
            $grid->column('id', 'ID');
            $grid->column('goods.name', '商品');
            $grid->column('goods_sku', 'SKU');
            $grid->column('sku_stock_end', '最终库存');
            $grid->column('action_sku_num', '操作')->display(function() {
                return $this->action . $this->action_sku_num;
            });
            $grid->column('sku_stock_begin', '开始库存');
            $grid->column('admin.name', '操作人');
            $grid->column('created_at', '操作时间');

            $grid->filter(function ($filter) {
                $filter->equal('goods_id', '商品')->select(Goods::pluck('name', 'id'));
                $filter->like('sku', 'SKU');
            });
            $grid->quickSearch(['goods.name','admin.name','sku'])->placeholder('搜索用户、商品名称、SKU');

            $grid->disableCreateButton();
            $grid->disableViewButton();
             $grid->disableEditButton();
            $grid->disableDeleteButton();
            $grid->scrollbarX();//数据展开
             $grid->disableActions();
             $grid->disableRowSelector();
        });
    }

}
