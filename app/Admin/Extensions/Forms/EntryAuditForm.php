<?php

namespace App\Admin\Extensions\Forms;

use App\Admin\Controllers\AdminInfoTrait;
use App\Enum\AuditState;
use App\Enum\OrderState;
use App\Exceptions\VerifyException;
use App\Models\Entry;
use App\Models\EntrySku;
use App\Models\GoodsSku;
use App\Models\Order;
use App\Models\SkuLog;
use Dcat\Admin\Contracts\LazyRenderable;
use Dcat\Admin\Traits\LazyWidget;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\DB;

class EntryAuditForm extends Form implements LazyRenderable
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
            $auditState = data_get($input, 'audit_state', 0);
            if (!$auditState) {
                return $this->response()->alert()->error('审核状态不能为空');
            }


            $entry = Entry::with(['goods', 'skus'])->find($id);
            if (!$entry) {
                return $this->response()->alert()->error("该入库单不存在");
            }
            if ($entry->audit_state == AuditState::SUCCESS) {
                return $this->response()->alert()->error("该入库单已审核通过");
            }

            DB::beginTransaction();
            try {
                foreach ($entry->skus as $entrySku) {
                    $goodsSku = GoodsSku::lockForUpdate()
                        ->where('goods_id', $entry->goods_id)
                        ->where('sku', $entrySku->sku)->first();
                    if (!$goodsSku) {
                        VerifyException::throwException('商品【' . $entrySku->goods->name . '】无此规格: 【' . $entrySku->sku . '】');
                    }

                    $effect = GoodsSku::where('goods_id', $entry->goods_id)
                        ->where('sku', $entrySku->sku)
                        ->update([
                            'stock' => DB::raw("stock+{$entrySku->num}")
                        ]);
                    if ($effect == 0) {
                        VerifyException::throwException('商品【' . $entry->goods->name . '】规格: 【' . $entrySku->sku . '】加库存失败。现有：' . $goodsSku->stock . ', 需要增加:' . $entrySku->num);
                    }
                    SkuLog::incrLog($adminId, $entrySku,$goodsSku);
                }
                $entry->audit_state = $auditState;
                $entry->save();
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
        $entryId = $this->payload['id'];
        $entry = Entry::with('goods')->where('id', $entryId)->first();
        $this->display('entry_sn', '入库单号')->value($entry->entry_sn);
        $this->display('goods_name', '商品')->value($entry->goods->name);
        $this->textarea('goods_info', '货物信息')->value($entry->getOrderSkuString())->disable();
        if ($entry->audit_state == AuditState::SUCCESS) {
            $this->select('audit_state', '订单状态')
                ->options(AuditState::asArray())
                ->default(AuditState::SUCCESS)
                ->disable();
        } else {
            $this->select('audit_state', '订单状态')->options(AuditState::asArray())->default(AuditState::PENDING);
        }

        $this->hidden('id')->value($entryId);
    }

}
