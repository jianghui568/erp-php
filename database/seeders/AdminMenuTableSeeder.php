<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_menu')->delete();
        
        \DB::table('admin_menu')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => 0,
                'order' => 1,
                'title' => 'Index',
                'icon' => 'feather icon-bar-chart-2',
                'uri' => '/',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 0,
                'order' => 11,
                'title' => 'Admin',
                'icon' => 'feather icon-settings',
                'uri' => '',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 2,
                'order' => 12,
                'title' => 'Users',
                'icon' => '',
                'uri' => 'auth/users',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 2,
                'order' => 13,
                'title' => 'Roles',
                'icon' => '',
                'uri' => 'auth/roles',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 2,
                'order' => 14,
                'title' => 'Permission',
                'icon' => '',
                'uri' => 'auth/permissions',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 2,
                'order' => 15,
                'title' => 'Menu',
                'icon' => '',
                'uri' => 'auth/menu',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 2,
                'order' => 16,
                'title' => 'Extensions',
                'icon' => '',
                'uri' => 'auth/extensions',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => 0,
                'order' => 6,
                'title' => '商品管理',
                'icon' => 'fa-shopping-basket',
                'uri' => '/goodsAttribute',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 09:05:52',
                'updated_at' => '2024-01-29 08:55:51',
            ),
            8 => 
            array (
                'id' => 10,
                'parent_id' => 8,
                'order' => 8,
                'title' => '商品信息',
                'icon' => NULL,
                'uri' => '/goods',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 09:06:49',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            9 => 
            array (
                'id' => 11,
                'parent_id' => 8,
                'order' => 7,
                'title' => '商品分类',
                'icon' => NULL,
                'uri' => '/goodsCategory',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 09:07:04',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            10 => 
            array (
                'id' => 12,
                'parent_id' => 0,
                'order' => 10,
                'title' => '供应商',
                'icon' => 'fa-bank',
                'uri' => '/vendor',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-23 09:47:31',
                'updated_at' => '2024-01-30 09:06:40',
            ),
            11 => 
            array (
                'id' => 15,
                'parent_id' => 0,
                'order' => 2,
                'title' => '出库',
                'icon' => 'fa-sign-out',
                'uri' => '/order',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-25 08:54:38',
                'updated_at' => '2024-01-29 08:51:56',
            ),
            12 => 
            array (
                'id' => 16,
                'parent_id' => 15,
                'order' => 3,
                'title' => '所有订单',
                'icon' => NULL,
                'uri' => '/order',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-25 08:55:00',
                'updated_at' => '2024-01-29 07:27:48',
            ),
            13 => 
            array (
                'id' => 17,
                'parent_id' => 15,
                'order' => 4,
                'title' => '我的订单',
                'icon' => NULL,
                'uri' => '/myOrder',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-29 01:50:19',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            14 => 
            array (
                'id' => 18,
                'parent_id' => 8,
                'order' => 9,
                'title' => '商品SKU库存',
                'icon' => NULL,
                'uri' => '/goods/skuStockList',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-29 07:20:29',
                'updated_at' => '2024-01-29 08:49:38',
            ),
            15 => 
            array (
                'id' => 19,
                'parent_id' => 0,
                'order' => 5,
                'title' => '入库',
                'icon' => 'fa-indent',
                'uri' => '/entry',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-29 08:08:58',
                'updated_at' => '2024-01-29 08:53:58',
            ),
            16 => 
            array (
                'id' => 20,
                'parent_id' => 19,
                'order' => 17,
                'title' => '订单',
                'icon' => NULL,
                'uri' => '/entry',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-29 08:50:27',
                'updated_at' => '2024-01-29 08:50:48',
            ),
            17 => 
            array (
                'id' => 21,
                'parent_id' => 8,
                'order' => 18,
                'title' => '商品SKU库存日志',
                'icon' => NULL,
                'uri' => '/skuLog',
                'extension' => '',
                'show' => 1,
                'created_at' => '2024-01-30 07:36:43',
                'updated_at' => '2024-01-30 07:36:43',
            ),
        ));
        
        
    }
}