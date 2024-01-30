<?php

namespace App\Admin\Extensions\Forms;

use App\Admin\Controllers\AdminInfoTrait;
use App\Enum\OrderState;
use App\Exceptions\VerifyException;
use App\Models\GoodsSku;
use App\Models\Order;
use App\Models\SkuLog;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\DB;

class OrderForm extends Form implements LazyRenderable
{
    use AdminInfoTrait;
    use LazyWidget;

    public function handle(array $input)
    {
        $adminId = $this->getAdminId();
        if (empty($input)) {
            return $this->response()->alert()->error("设置失败1");
        } else {
            $id = (int)data_get($input, 'id', 0);
            $track_sn = data_get($input, 'track_sn', '');
            $state = data_get($input, 'state', OrderState::SHIPPED);
            if (!$track_sn) {
                return $this->response()->alert()->error('物流编号不能为空');
            }
            if (!$state) {
                return $this->response()->alert()->error('订单状态不能为空');
            }

            $order = Order::with(['goods', 'skus'])->find($id);
            if (!$order) {
                return $this->response()->alert()->error("该订单不存在");
            }
            if ($order->track_sn) {
                return $this->response()->alert()->error('物流单号已存在，不可重复设置');
            }

            DB::beginTransaction();
            try {
                foreach ($order->skus as $orderSku) {
                    $goodsSku = GoodsSku::lockForUpdate()
                        ->where('goods_id', $order->goods_id)
                        ->where('sku', $orderSku->sku)->first();
                    if (!$goodsSku) {
                        VerifyException::throwException('商品【' . $order->goods->name . '】无此规格: 【' . $orderSku->sku . '】');
                    }

                    if ($goodsSku->stock < $orderSku->num) {
                        VerifyException::throwException('商品【' . $order->goods->name . '】规格: 【' . $goodsSku->sku . '】库存(' . $goodsSku->stock . ')不足, 需要扣除:' . $orderSku->num);
                    }

                    $effect = GoodsSku::where('goods_id', $order->goods_id)
                        ->where('sku', $orderSku->sku)
                        ->where('stock', '>=', $orderSku->num)
                        ->update([
                            'stock' => DB::raw("stock-{$orderSku->num}")
                        ]);
                    if ($effect == 0) {
                        VerifyException::throwException('商品【' . $order->goods->name . '】规格: 【' . $orderSku->sku . '】扣库存失败。现有' . $goodsSku->stock . ', 需要扣除:' . $orderSku->num);
                    }
                    SkuLog::reduceLog($adminId, $orderSku,$goodsSkuBegin);
                }

                $order->track_sn = $track_sn;
                $order->state = $state;
                $order->save();
                DB::commit();
            } catch (VerifyException $exception) {
                DB::rollBack();
                return $this->response()->alert()->error($exception->getMessage());
            } catch (\Exception $exception) {
                DB::rollBack();
                return $this->response()->alert()->error($exception->getMessage());
            }

            return $this->response()->success("设置成功")->refresh();
        }
    }

    public function form()
    {
        $orderId = $this->payload['id'];
        $order = Order::where('id', $orderId)->first();
        $this->display('customer_order_sn', '订单编号')->value($order->customer_order_sn);
        $this->display('customer_name', '用户名')->value($order->customer_name);
        $this->display('customer_phone', '手机号')->value($order->customer_phone);
        $this->display('customer_address', '收货地址')->value($order->customer_address);
        $this->textarea('goods_info', '货物信息')->value($order->getOrderSkuString())->disable();
        $this->text('track_sn', '物流编号')->value(strval($order->track_sn))->required();
        $this->select('state', '订单状态')->options(OrderState::asArray())->default(OrderState::SHIPPED);

        $this->hidden('id')->value($orderId);
    }

}
