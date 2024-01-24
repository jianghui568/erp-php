<?php

namespace App\Admin\Controllers;

use App\Models\GoodsCategory;
use Dcat\Admin\Form;

use Dcat\Admin\Grid;
use Dcat\Admin\Http\Actions\Menu\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Widgets\Form as WidgetForm;


class GoodsCategoryController extends AdminController
{
    protected $title='商品分类';
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(GoodsCategory::class, function (Grid $grid) {
            $grid->column('id','ID');
            $grid->column('name','分类');
            $grid->column('sort','排序');


            $grid->filter(function($filter){
                $filter->like('name','分类');
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
        return Form::make(new GoodsCategory(), function (Form $form) {
            $form->hidden('id');
            $form->hidden('pid')->default(0);
            $form->hidden('depth')->default(0);
            $form->hidden('path')->default('');
            $form->text('name','分类')->required();
            $form->number('sort','排序')->default(0);

            $form->submitted(function($form) {
                if ($form->isCreating()) {
                    if (GoodsCategory::where('name', $form->name)->exists()) {
                        $form->responseValidationMessages('name', '分类名不能重复');
                    }
                } elseif ($form->isEditing()) {
                    if (GoodsCategory::where('name', $form->name)->where('id', '!=', $form->model()->getKey())->exists()) {
                        $form->responseValidationMessages('name', '分类名不能重复');
                    }
                }
            });
            $form->saving(function($form) {
                $form->depth = 0;
                $form->path = $form->name;
                if ($form->pid) {
                    $p = GoodsCategory::find($form->pid);
                    $form->depth = $p->depth + 1;
                    $form->path .= '/'.$form->name;
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
