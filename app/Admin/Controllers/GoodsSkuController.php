<?php

namespace App\Admin\Controllers;

use App\Models\GoodsSku;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Controllers\AdminController;


class GoodsSkuController extends AdminController
{
    protected $title='商品属性';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(GoodsSku::class, function (Grid $grid) {
            $grid->column('name','属性名')->help('SKU');
            $grid->column('val','属性值')->help('多个值回车');

            $grid->filter(function($filter){
                $filter->like('name','属性名');
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
        return Form::make(new GoodsSku(), function (Form $form) {
            $form->hidden('id');
            $form->text('name','属性名')->required()->help('SKU');
            $form->textarea('val','属性值')->required()->help('多个值回车');
            $form->submitted(function (Form $form) {
                if ($form->isCreating()) {
                    if (GoodsSku::where('name', $form->name)->exists()) {
                        $form->responseValidationMessages('name', '属性名不能重复');
                    }
                } elseif ($form->isEditing()) {
                    if (GoodsSku::where('name', $form->name)->where('id', '!=', $form->model()->id)->exists()) {
                        $form->responseValidationMessages('name', '属性名不能重复');
                    }
                }
            });

            $form->footer(function($footer) {
                // 去掉`查看`checkbox
                $footer->disableViewCheck();
                // 去掉`继续编辑`checkbox
//                $footer->disableEditingCheck();
            });
        });
    }
}
