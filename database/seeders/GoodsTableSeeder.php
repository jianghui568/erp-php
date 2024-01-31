<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('goods')->delete();
        
        \DB::table('goods')->insert(array (
            0 => 
            array (
                'id' => 4,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => '多格果盘',
                'mfrs' => '',
                'model' => '',
                'standard' => '',
                'color' => '',
                'expiry_num' => 0,
                'sku_info' => '{"sku": [{"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "白色"}, {"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "白色"}, {"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "白色"}, {"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "金色"}, {"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "金色"}, {"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "金色"}, {"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "绿色"}, {"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "绿色"}, {"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "绿色"}, {"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "灰色"}, {"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "灰色"}, {"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "灰色"}], "attrs": {"规格": ["2格", "4格", "6格"], "颜色": ["白色", "金色", "绿色", "灰色"]}}',
                'weight' => '0.000000',
                'enabled' => 0,
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            1 => 
            array (
                'id' => 8,
                'category_id' => 1,
                'vendor_id' => 1,
                'name' => '花瓣果盘',
                'mfrs' => '',
                'model' => '',
                'standard' => '',
                'color' => '',
                'expiry_num' => 0,
                'sku_info' => '{"sku": [{"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "白色"}, {"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "绿色"}, {"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "金色"}, {"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "黑色"}, {"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "白色"}, {"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "绿色"}, {"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "金色"}, {"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "黑色"}], "attrs": {"规格": ["大号", "小号"], "颜色": ["白色", "绿色", "金色", "黑色"]}}',
                'weight' => '0.000000',
                'enabled' => 0,
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:23:33',
            ),
        ));
        
        
    }
}