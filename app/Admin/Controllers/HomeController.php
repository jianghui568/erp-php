<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Admin\Metrics\Home\GoodsSkuMetrics;
use App\Admin\Metrics\Home\OrderMetrics;
use App\Http\Controllers\Controller;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class HomeController extends Controller
{
    use AdminInfoTrait;
    public function index(Content $content)
    {
        $hour = date('H');
        $greeting = '';
        if ($hour >=6 && $hour <12) {
            $greeting = '上午';

        }else if ( $hour == 12) {
            $greeting = '中午';

        }else if ( $hour > 12 && $hour <= 18) {
            $greeting = '下午';

        }else if ( $hour > 18 && $hour <= 21) {
            $greeting = '晚上';

        } else {
            $greeting = '深夜';
        }
        $time = date('Y-m-d H:i:s');
        return $content
            ->header('订单大盘数据')
            ->description("亲爱的{$this->getAdminName()}老板，{$greeting}好，当前时间为：{$time}")
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row(new OrderMetrics());
                });
                $row->column(6, function (Column $column) {
                    $column->row(new GoodsSkuMetrics());
                });
            });
    }
}
