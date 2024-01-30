<?php

namespace App\Admin\Metrics\Home;

use App\Admin\Controllers\AdminInfoTrait;
use App\Enum\OrderState;
use App\Models\AdminUser;
use App\Models\Order;
use Dcat\Admin\Widgets\Metrics\RadialBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderMetrics extends RadialBar
{
    use AdminInfoTrait;
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $users = AdminUser::pluck('name', 'id')->toArray();
        array_unshift($users,  '全部租户');
        $time = date('Y-m-d H:i:s');
        $this->title('截止到'.$time . '，【未发货】订单数据');
        $this->height(180);

        $this->dropdown($users);

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
        $adminId = $request->input('option');
        $this->withContent($adminId);
    }

    /**
     * 卡片内容
     *
     * @param string $content
     *
     * @return $this
     */
    public function withContent($adminId)
    {
        $adminName = '全部租户';
        if ($adminId) {
            $admin = AdminUser::find($adminId);
            $adminName = $admin->name;
        }

        $query = Order::with('skus');
        if ($adminId) {
            $query->where('admin_id', $adminId);
        }
        $orders = $query->where('state', OrderState::PAID)->get();
        $goodsNum = 0;
        $orderNum = $orders->count();

        foreach ($orders as $order) {
            $goodsNum += $order->skus->sum('num');
        }
        $orderPaid = OrderState::PAID;

        return $this->footer(
            <<<HTML
<div class="d-flex justify-content-between p-1" style="padding-top: 0!important;">
    <div class="text-center">
        <p>租户</p>
           <span >{$adminName}</span>
    </div>
    <div class="text-center">
        <p>订单数</p>
        <a class="font-lg-1" href="/admin/order?state={$orderPaid}&admin_id={$adminId}" target="_blank">{$orderNum}</a>
    </div>
    <div class="text-center">
        <p>商品件数</p>
        <span class="font-lg-1">{$goodsNum}</span>
    </div>
</div>
HTML
        );
    }
}
