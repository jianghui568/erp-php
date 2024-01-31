<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodsSkuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('goods_sku')->delete();
        
        \DB::table('goods_sku')->insert(array (
            0 => 
            array (
                'id' => 1,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '2格,白色',
                'purchase_price' => '0.00',
                'retail_price' => '24.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "白色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            1 => 
            array (
                'id' => 2,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '4格,白色',
                'purchase_price' => '0.00',
                'retail_price' => '36.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "白色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            2 => 
            array (
                'id' => 3,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '6格,白色',
                'purchase_price' => '0.00',
                'retail_price' => '45.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "白色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            3 => 
            array (
                'id' => 4,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '2格,金色',
                'purchase_price' => '0.00',
                'retail_price' => '24.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "金色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            4 => 
            array (
                'id' => 5,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '4格,金色',
                'purchase_price' => '0.00',
                'retail_price' => '36.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "金色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            5 => 
            array (
                'id' => 6,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '6格,金色',
                'purchase_price' => '0.00',
                'retail_price' => '45.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "金色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            6 => 
            array (
                'id' => 7,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '2格,绿色',
                'purchase_price' => '0.00',
                'retail_price' => '24.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "绿色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            7 => 
            array (
                'id' => 8,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '4格,绿色',
                'purchase_price' => '0.00',
                'retail_price' => '36.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "绿色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            8 => 
            array (
                'id' => 9,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '6格,绿色',
                'purchase_price' => '0.00',
                'retail_price' => '45.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "绿色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            9 => 
            array (
                'id' => 10,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '2格,灰色',
                'purchase_price' => '0.00',
                'retail_price' => '24.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "24", "规格": "2格", "颜色": "灰色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            10 => 
            array (
                'id' => 11,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '4格,灰色',
                'purchase_price' => '0.00',
                'retail_price' => '36.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "36", "规格": "4格", "颜色": "灰色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            11 => 
            array (
                'id' => 12,
                'goods_id' => 4,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '6格,灰色',
                'purchase_price' => '0.00',
                'retail_price' => '45.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "45", "规格": "6格", "颜色": "灰色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:13:43',
                'updated_at' => '2024-01-30 02:13:43',
            ),
            12 => 
            array (
                'id' => 16,
                'goods_id' => 8,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '大号,白色',
                'purchase_price' => '0.00',
                'retail_price' => '14.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "白色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:23:33',
            ),
            13 => 
            array (
                'id' => 17,
                'goods_id' => 8,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '大号,绿色',
                'purchase_price' => '0.00',
                'retail_price' => '14.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "绿色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:23:33',
            ),
            14 => 
            array (
                'id' => 18,
                'goods_id' => 8,
                'stock' => 10,
                'pic' => '',
                'unit' => '',
                'sku' => '大号,金色',
                'purchase_price' => '0.00',
                'retail_price' => '14.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "金色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:27:35',
            ),
            15 => 
            array (
                'id' => 19,
                'goods_id' => 8,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '大号,黑色',
                'purchase_price' => '0.00',
                'retail_price' => '14.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "14", "规格": "大号", "颜色": "黑色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:23:33',
            ),
            16 => 
            array (
                'id' => 20,
                'goods_id' => 8,
                'stock' => 10,
                'pic' => '',
                'unit' => '',
                'sku' => '小号,白色',
                'purchase_price' => '0.00',
                'retail_price' => '12.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "白色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:27:35',
            ),
            17 => 
            array (
                'id' => 21,
                'goods_id' => 8,
                'stock' => 10,
                'pic' => '',
                'unit' => '',
                'sku' => '小号,绿色',
                'purchase_price' => '0.00',
                'retail_price' => '12.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "绿色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:27:35',
            ),
            18 => 
            array (
                'id' => 22,
                'goods_id' => 8,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '小号,金色',
                'purchase_price' => '0.00',
                'retail_price' => '12.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "金色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:23:33',
            ),
            19 => 
            array (
                'id' => 23,
                'goods_id' => 8,
                'stock' => 0,
                'pic' => '',
                'unit' => '',
                'sku' => '小号,黑色',
                'purchase_price' => '0.00',
                'retail_price' => '12.00',
                'sku_meta' => '{"pic": "", "price": "", "stock": "", "retail": "12", "规格": "小号", "颜色": "黑色"}',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:23:33',
                'updated_at' => '2024-01-30 02:23:33',
            ),
        ));
        
        
    }
}