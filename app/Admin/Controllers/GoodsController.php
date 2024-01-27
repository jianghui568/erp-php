<?php

namespace App\Admin\Controllers;

use App\Models\Goods;
use App\Models\GoodsCategory;
use App\Models\GoodsSku;
use App\Models\Vendor;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class GoodsController extends AdminController
{
    protected $title='商品信息';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Goods::class, function (Grid $grid) {
            $grid->model()->with(['category', 'vendor'])->orderBy('id', 'desc');
            $grid->column('id','ID');
            $grid->column('category.name','分类');
            $grid->column('vendor.name','供货商');
            $grid->column('name','商品名')->expand(function($model) {

                return view('admin.goods.goods_sku', ['model' => $this]);
            });
            $grid->column('weight','重量kg');
            $grid->column('mfrs','制造商');
            $grid->column('model','型号');
            $grid->column('color','颜色');
            $grid->column('expiry_num','保质期(天)');
//            $grid->column('SKU','SKU')->link(fn() => admin_route('posts.edit',[$this->id]),'self');
            $grid->filter(function($filter){
                $filter->equal('category_id','分类')->select(GoodsCategory::pluck('name', 'id'));
                $filter->equal('vendor_id','供应商')->select(Vendor::pluck('name', 'id'));
                $filter->like('name','商品名');
            });

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
        return Form::make(new Goods(), function (Form $form) {
            $form->hidden('id');
            $form->select('category_id','分类')->options(GoodsCategory::pluck('name', 'id'))->required();
            $form->select('vendor_id','供应商')->options(Vendor::pluck('name', 'id'))->required();
            $form->text('name','商品名')->required();
            $form->decimal('weight','重量kg')->default(0);
            $form->text('mfrs','制造商')->default('');
            $form->text('model','型号')->default('');
            $form->text('color','颜色')->default('');
            $form->number('expiry_num','保质期(天)')->default(0);

            $sku_params = [
                [
                    'name'    => '建议零售价格', // table 第一行 title
                    'field'   => 'retail', // input 的 field_name 名称
                    'default' => '0', // 默认值
                ],
            ];
            if ($form->isCreating()) {
                $form->sku('sku_info', json_encode($sku_params))->display(true);
            }
            if ($form->isEditing()) {

                $form->sku('sku_info', json_encode($sku_params))->display(true)->customFormat(function ($value) use ($form){
                    return $form->model()->getSkuDataForEdit();
                });
            }

            // 获取提交的数据.
            // {"颜色":"绿","款式":"2格","pic":"","stock":"100","price":"20.8","retail":"5"}
            $form->submitted(function ( $form) {

                // 拿到SKU数据，按照业务逻辑做响应处理即可。
                $form->sku_info = json_decode($form->sku_info, JSON_UNESCAPED_UNICODE);
                $sku = Arr::get($form->sku_info, 'sku');
                if (!$sku) {
                    return $form->responseValidationMessages('sku_info', ['请填写商品SKU']);
                }

                foreach ($sku as $item) {
                    $err = GoodsSku::verifySkuItem($item);
                    if ($err) {
                        return $form->responseValidationMessages('sku_info', [$err]);
                    }
                }
                if ($form->weight === null) $form->weight = 0;
                if ($form->mfrs=== null) $form->mfrs = '';
                if ($form->model=== null) $form->model = '';
                if ($form->color=== null) $form->color = '';
                if ($form->expiry_num=== null) $form->expiry_num = 0;
            });
            $form->saved(function (Form $form) {
                // 拿到SKU数据，按照业务逻辑做响应处理即可。
                $skuInfo = $form->sku_info;
                $sku = Arr::get($skuInfo, 'sku');
                $attrs = Arr::get($skuInfo, 'attrs');
                foreach ($sku as $item) {
                    $skuList = [];
                    foreach ($attrs as $name => $vals) {
                        $skuList[] = Arr::get($item, $name);
                    }
                    sort($skuList);

                    $skuKey = implode(',', $skuList);

                    $sku = GoodsSku::where('goods_id', $form->getKey())->where('sku', $skuKey)->first();
                    if (!$sku) {
                        $sku = new GoodsSku();
                    }
                    $sku->sku_meta = $item;
                    $sku->goods_id = $form->getKey();
                    $sku->stock = Arr::get($item, 'stock', 0);
                    $sku->pic = Arr::get($item, 'pic', '');
                    $sku->unit = Arr::get($item, 'unit', '');
                    $sku->purchase_price = Arr::get($item, 'price', 0);
                    $sku->retail_price = Arr::get($item, 'retail', 0);
                    $sku->sku = $skuKey;
                    $sku->save();
                }
            });

            $form->deleted(function (Form $form, $result) {

                GoodsSku::where('goods_id', $form->getKey())->delete();
                // 返回删除成功提醒，此处跳转参数无效
                return $form->response()->success('删除成功');
            });
        });
    }

    public function skuList(Request $request) {
        $goodsId = $request->input('goods_id');
        if (!$goodsId) {
            return [];
        }
        $goodsSku = GoodsSku::where('goods_id', $goodsId)->pluck('sku');

        return $goodsSku;
    }
}
