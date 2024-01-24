<?php

namespace App\Admin\Controllers;

use App\Models\GoodsSku;
use App\Models\Vendor;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Controllers\AdminController;


class VendorController extends AdminController
{
    protected $title='供应商';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Vendor::class, function (Grid $grid) {
            $grid->column('name','供应商');
            $grid->column('contactor','联系人');
            $grid->column('phone','手机号');
            $grid->column('address_full','地址');

            $grid->filter(function($filter){
                $filter->like('name','供应商');
                $filter->like('contactor','联系人');
                $filter->like('phone','手机号');
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
        return Form::make(new Vendor(), function (Form $form) {
            $form->hidden('id');
            $form->text('name','供应商')->required();
            $form->text('contactor','联系人')->default('');
            $form->text('phone','手机号')->default('');
            $form->text('address_full','地址')->default('');

            $form->saving(function ($form) {
                $form->contactor = $form->contactor ?: '';
                $form->phone = $form->phone ?: '';
                $form->address_full = $form->address_full ?: '';
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
