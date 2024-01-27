<?php

namespace App\Admin\Controllers;

use App\Models\GoodsCategory;
use Dcat\Admin\Form;

use Dcat\Admin\Http\Actions\Menu\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Widgets\Form as WidgetForm;


class GoodsCategoryControllerbak extends AdminController
{
    protected $title='商品属性';
    /**
     * Make a grid builder.
     *
     * @return Content
     */
    public function index(Content $content)
    {
        return $content->header('商品分类')
            ->body(function (Row $row) {
                $tree = new Tree(new GoodsCategory);

                $row->column(6, $this->treeView()->render());

                $row->column(6, function (Column $column) {
                    $form = new WidgetForm();
                    $form->select('pid', '上级分类')->options(GoodsCategory::selectOptions());
                    $form->text('name', '分类')->required();
                    $form->icon('sort', '排序')->default(0);
                    $form->width(9, 2);

                    $column->append(Box::make(trans('admin.new'), $form));
                });
            });
    }

    protected function treeView()
    {
        return new Tree(new GoodsCategory(), function (Tree $tree) {
            $tree->disableCreateButton();
            $tree->disableQuickCreateButton();
            $tree->disableEditButton();
            $tree->maxDepth(3);

            $tree->actions(function (Tree\Actions $actions) {
                if ($actions->getRow()->extension) {
                    $actions->disableDelete();
                }

                $actions->prepend(new Show());
            });

            $tree->branch(function ($branch) {
                $payload = "<strong>{$branch['name']}</strong>";

                return $payload;
            });
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
