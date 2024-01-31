<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_reset_tokens_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2016_01_04_173148_create_admin_tables',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2020_09_07_090635_create_admin_settings_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2020_09_22_015815_create_admin_extensions_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2020_11_01_083237_update_admin_menu_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 2,
            ),
            9 => 
            array (
                'id' => 65,
                'migration' => '2024_01_23_081623_create_goods_table',
                'batch' => 3,
            ),
            10 => 
            array (
                'id' => 66,
                'migration' => '2024_01_23_081831_create_goods_sku_table',
                'batch' => 3,
            ),
            11 => 
            array (
                'id' => 67,
                'migration' => '2024_01_23_081840_create_goods_category_table',
                'batch' => 3,
            ),
            12 => 
            array (
                'id' => 68,
                'migration' => '2024_01_23_094850_create_vendor_table',
                'batch' => 3,
            ),
            13 => 
            array (
                'id' => 69,
                'migration' => '2024_01_24_123533_create_order_table',
                'batch' => 3,
            ),
            14 => 
            array (
                'id' => 70,
                'migration' => '2024_01_27_083418_create_order_sku_table',
                'batch' => 3,
            ),
            15 => 
            array (
                'id' => 71,
                'migration' => '2024_01_27_105414_create_sku_log_table',
                'batch' => 3,
            ),
            16 => 
            array (
                'id' => 72,
                'migration' => '2024_01_29_081009_create_entry_table',
                'batch' => 3,
            ),
            17 => 
            array (
                'id' => 73,
                'migration' => '2024_01_29_081458_create_entry_sku_table',
                'batch' => 3,
            ),
        ));
        
        
    }
}