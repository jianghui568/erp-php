<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Forms\EntryAuditForm;
use App\Admin\Extensions\Tools\GoodsSelect;
use App\Enum\AuditState;
use App\Models\AdminUser;
use App\Models\Entry;
use App\Models\EntrySku;
use App\Models\Goods;
use App\Models\GoodsSku;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Arr;


class EntryController extends AdminController
{
    use AdminInfoTrait;

    protected $title = '入库订单';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Entry::class, function (Grid $grid) {
            $grid->model()->with(['admin', 'goods', 'skus'])->orderBy('id', 'desc');
            $grid->column('id', 'ID');
            $grid->column('admin.name', '租户');
            $grid->column('audit_state', '审核状态')
                ->display(function() {
                    return Arr::get(AuditState::asArray(), $this->audit_state, '-');
                })
                ->modal('审核入库单', function (Grid\Displayers\Modal $modal) {
                    // 审核成功的，不需要再次审核
                    if ($this->audit_state == AuditState::SUCCESS) {
                        return false;
                    }
                // 自定义图标
                $modal->icon('feather icon-edit');
                // 传递当前行字段值
                return EntryAuditForm::make()->payload(['id' => $this->id]);
            });
            $grid->column('pay_money', '实付金额');
            $grid->column('entry_sn', '入库单号');
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


            $grid->column('created_at', '创建时间');

            $grid->filter(function ($filter) {
                $filter->equal('admin_id', '租户')->select(AdminUser::pluck('name', 'id'));
                $filter->like('entry_sn', '入库单号');
            });
            $grid->quickSearch(['entry_sn'])->placeholder('搜索入库单号');

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $status = $actions->row->audit_state;
                // 如果状态为某个特定值，显示编辑和删除按钮
                if ($status != AuditState::SUCCESS) {
                    $actions->edit();
                    $actions->delete();
                } else {
                    // 否则，可以显示其他操作按钮或者不显示任何按钮
                    // $actions->append(...);
                    $actions->disableDelete();
                    $actions->disableEdit();
                }
            });

            $grid->tools((new GoodsSelect())->setUriPrefix('entry'));
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

        return Form::make(new Entry(), function (Form $form) {

            if ($form->isEditing()) {
                if ($form->model()->audit_state == AuditState::SUCCESS) {
                    return $form->responseValidationMessages('id', ["入库单【{$form->getKey()}】已审核通过，不可编辑"]);
                }
            }

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
            $form->text('entry_sn', '入库单号')->required();
            $form->decimal('pay_money', '实付金额')->required();
            $form->table('goods_info', '货物商品的SKU', function ($form) use ($goodsId) {
                $form->select('sku', 'SKU')
                    ->options(GoodsSku::where('goods_id', $goodsId)->pluck('sku', 'sku'));
                $form->number('num', '数量');
            })->saving(function ($v) {
                // 转化为json格式存储
                return json_encode($v);
            });

            $form->hidden('audit_state', '审核状态')->value(AuditState::PENDING);
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
                $form->entry_sn = $form->entry_sn?? '';
            });

            $form->saved(function (Form $form) {
                // 拿到SKU数据，按照业务逻辑做响应处理即可。
                $entryId = $form->getKey();
                $entry = Entry::find($entryId);
                $goodsInfo = $form->goods_info;

                EntrySku::where('entry_id', $entry->id)->delete();
                foreach ($goodsInfo as $item) {
                    $orderSku = new EntrySku();
                    $orderSku->entry_id = $entry->id;
                    $orderSku->sku = $item['sku'];
                    $orderSku->num = $item['num'];
                    $orderSku->save();
                }
            });
        });
    }

}
