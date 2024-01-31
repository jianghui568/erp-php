<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GoodsCategoryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('goods_category')->delete();
        
        \DB::table('goods_category')->insert(array (
            0 => 
            array (
                'id' => 1,
                'pid' => 0,
                'name' => '果盘',
                'depth' => '0',
                'path' => '果盘',
                'sort' => 0,
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:07:51',
                'updated_at' => '2024-01-30 02:07:51',
            ),
        ));
        
        
    }
}