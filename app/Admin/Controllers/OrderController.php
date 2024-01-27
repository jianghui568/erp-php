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
use App\Models\Vendor;
use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class OrderController extends AdminController
{
    use AdminInfoTrait;

    protected $title = '订单信息';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Order::class, function (Grid $grid) {
            $grid->model()->with(['admin', 'goods', 'skus'])->orderBy('id', 'desc');
            $grid->column('id', 'ID');
            $grid->column('admin.name', '租户');
            $grid->column('customer_order_sn', '订单号')->modal('修改订单状态', function ($modal) {
                // 标题
                $modal->title('设置平台代理人');
                // 自定义图标
                $modal->icon('feather icon-edit');
                // 传递当前行字段值
                return OrderForm::make()->payload(['id' => $this->id]);
            });
            $grid->column('pay_money', '支付金额');
            $grid->column('customer_name', '用户');
            $grid->column('customer_phone', '手机号');
            $grid->column('customer_address', '收货地址');
            $grid->column('goods.name', '商品');
            $grid->column('goods_info', '货物信息')->display(function ($goodsInfo) {
                $info = [];
                $goodsInfo = (array)json_decode($this->goods_info, true);
//                dd($goodsInfo);
                foreach ($goodsInfo as $item) {
                    $info[] = $item['sku'] . '：' . $item['num'];
                }
                return implode("</br>", $info);
            });
            $grid->column('goods_num', '货物总数量')->display(function () {

                return $this->skus->sum('num');
            });

            $grid->column('track_sn', '物流单号');
            $grid->column('state', '订单状态')->display(function () {
                return Arr::get(OrderState::asArray(), $this->state, '-');
            });

            $grid->column('pay_at', '支付时间');
            $grid->column('return_at', '退货时间');

//            $grid->column('SKU','SKU')->link(fn() => admin_route('posts.edit',[$this->id]),'self');
            $grid->filter(function ($filter) {
                $filter->equal('admin_id', '租户')->select(AdminUser::pluck('name', 'id'));
                $filter->equal('state', '订单状态')->select(OrderState::asArray());
                $filter->like('customer_order_sn', '订单号');
                $filter->like('track_sn', '物流单号');
                $filter->like('customer_name', '用户');
                $filter->like('customer_phone', '手机号');

            });

            $grid->tools(new GoodsSelect());
            $grid->disableCreateButton();
            $grid->disableViewButton();
//             $grid->disableEditButton();
//            $grid->disableDeleteButton();
            $grid->scrollbarX();//数据展开
            // $grid->disableActions();
            // $grid->disableRowSelector();
        });
    }


    protected function form()
    {
        $js = $this->formJs();

        Admin::script($js);
        return Form::make(new Order(), function (Form $form) {

            $goodsId = \request()->input('goods_id');
            if (!$form->isCreating()) {
                $goodsId = $form->model()->goods_id;
            }
            $goods = Goods::find($goodsId);
            $form->hidden('id');
            $form->hidden('goods_id')->value($goodsId);
            $form->hidden('admin_id', '租户')->value($this->getAdminId());
            $form->text('goods_name', '商品')->value($goods->name)
                ->disable();
            $form->text('customer_order_sn', '订单号')->required();
            $form->decimal('pay_money', '实收金额')->required();
            $form->textarea('customer_info', '收货信息')
                ->addElementClass('customer_info')
                ->help('第一行名字，第二行手机号，第三行收货地址，每行以回车分割;该字段的信息会自动识别为：用户名，、手机号和收货地址');

            $form->text('customer_name', '用户名')
                ->addElementClass('customer_name')->required();
            $form->text('customer_phone', '手机号')
                ->addElementClass('customer_phone')->required();
            $form->text('customer_address', '收货地址')
                ->addElementClass('customer_address')->required();
//            $form->number('goods_num','货物数量')->default(0);

            $form->table('goods_info', '货物商品的SKU', function ($form) use ($goodsId) {

                $form->select('sku', 'SKU')
                    ->options(GoodsSku::where('goods_id', $goodsId)->pluck('sku', 'sku'));
                $form->number('num', '数量');
            })->saving(function ($v) {
                // 转化为json格式存储
                return json_encode($v);
            });

            $form->select('state', '订单状态')->options(OrderState::asArray())->default(OrderState::PAID);

            $form->text('track_sn', '物流单号')->default('');

            $form->submitted(function ($form) {

                $goodsInfoAll = $form->goods_info;
                $goodsInfo = [];
                $goodsSkuNameMap = [];
                foreach ($goodsInfoAll as $item) {
                    if (!$item['_remove_']) {
                        if ($item['num'] < 1) {
                            return $form->responseValidationMessages('goods_info', ['货物商品SKU【' . $item['sku'] . '】的数量不能为0']);
                        }
                        $goodsInfo[] = $item;
                        @$goodsSkuNameMap[$item['sku']] += 1;
                    }
                }
                if (!$goodsInfo) {
                    return $form->responseValidationMessages('goods_info', ['请填写货物商品的SKU']);
                }
                foreach ($goodsSkuNameMap as $name => $num) {
                    if ($num > 1) {
                        return $form->responseValidationMessages('goods_info', ['货物商品SKU【' . $name . '】重复']);
                    }
                }
                $form->goods_info = $goodsInfo;
                if (!$form->track_sn) $form->track_sn = '';
                $form->deleteInput('customer_info');
            });

            $form->saved(function (Form $form) {
                // 拿到SKU数据，按照业务逻辑做响应处理即可。
                $orderId = $form->getKey();
                $order = Order::find($orderId);
                $goodsInfo = $form->goods_info;

                OrderSku::where('order_id', $order->id)->delete();
                foreach ($goodsInfo as $item) {
                    $orderSku = new OrderSku();
                    $orderSku->order_id = $order->id;
                    $orderSku->sku = $item['sku'];
                    $orderSku->num = $item['num'];
                    $orderSku->save();
                }
            });
        });
    }

    public function formJs()
    {
        return <<<JS
            $(document).ready(function () {
                // 收货信息
                var customer_info = $('.customer_info');
                customer_info.on('input', function () {
                    var content = customer_info.val();
                    var customerInfo = content.split(/\\r\\n|\\r|\\n/);
                    if (customerInfo.length >= 3) {
                        $('.customer_name').val(customerInfo[0]);
                        $('.customer_phone').val(customerInfo[1]);
                        $('.customer_address').val(customerInfo[2]);
                    }
                    // 在这里执行你想要的操作，例如发送到后端或更新其他元素
                });

                // 商品变更
                 $('.goods_id').change(function() {
                    // 在这里执行选择框变化后的操作
                    var goodsId = $(this).val();
                    console.log("选择框的值变化为：" + goodsId);

                    $.ajax({
                        url: '/admin/goods/skuList?goods_id=' + goodsId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            var options = '';
                            for (var sku of data) {
                                options += '<option value="'+sku+'">'+sku+'</option>';
                            }
                            console.log(options);
                            $('.goods_info_sku').val(options);
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            // 处理 AJAX 请求失败的逻辑
                            console.error('Ajax request failed:', textStatus, errorThrown);
                        }
                    });
                });
            });
JS;
    }
}
