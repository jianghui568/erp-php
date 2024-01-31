<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminExtensionHistoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_extension_histories')->delete();
        
        \DB::table('admin_extension_histories')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'lty5240.dcat-easy-sku',
                'type' => 1,
                'version' => '1.0.0',
                'detail' => 'Initialize extension.',
                'created_at' => '2024-01-24 06:54:10',
                'updated_at' => '2024-01-24 06:54:10',
            ),
            1 => 
            array (
                'id' => 4,
                'name' => 'lty5240.dcat-easy-sku',
                'type' => 1,
                'version' => '1.0.1',
                'detail' => '修复attrs超过两个会不显示的问题',
                'created_at' => '2024-01-24 06:54:10',
                'updated_at' => '2024-01-24 06:54:10',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'lty5240.dcat-easy-sku',
                'type' => 1,
                'version' => '1.0.1',
                'detail' => '更新了上传图片样式',
                'created_at' => '2024-01-24 06:54:10',
                'updated_at' => '2024-01-24 06:54:10',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'lty5240.dcat-easy-sku',
                'type' => 1,
                'version' => '1.1.0',
                'detail' => '新增快速批量插入输入框的数值',
                'created_at' => '2024-01-24 06:54:10',
                'updated_at' => '2024-01-24 06:54:10',
            ),
        ));
        
        
    }
}