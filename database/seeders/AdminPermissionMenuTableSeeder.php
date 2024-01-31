<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminPermissionMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_permission_menu')->delete();
        
        \DB::table('admin_permission_menu')->insert(array (
            0 => 
            array (
                'permission_id' => 7,
                'menu_id' => 1,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            1 => 
            array (
                'permission_id' => 7,
                'menu_id' => 8,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            2 => 
            array (
                'permission_id' => 7,
                'menu_id' => 10,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            3 => 
            array (
                'permission_id' => 7,
                'menu_id' => 11,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            4 => 
            array (
                'permission_id' => 7,
                'menu_id' => 12,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            5 => 
            array (
                'permission_id' => 7,
                'menu_id' => 15,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            6 => 
            array (
                'permission_id' => 7,
                'menu_id' => 16,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            7 => 
            array (
                'permission_id' => 7,
                'menu_id' => 17,
                'created_at' => '2024-01-29 02:15:23',
                'updated_at' => '2024-01-29 02:15:23',
            ),
            8 => 
            array (
                'permission_id' => 7,
                'menu_id' => 18,
                'created_at' => '2024-01-29 07:20:29',
                'updated_at' => '2024-01-29 07:20:29',
            ),
            9 => 
            array (
                'permission_id' => 7,
                'menu_id' => 19,
                'created_at' => '2024-01-29 08:08:58',
                'updated_at' => '2024-01-29 08:08:58',
            ),
            10 => 
            array (
                'permission_id' => 7,
                'menu_id' => 20,
                'created_at' => '2024-01-29 08:50:27',
                'updated_at' => '2024-01-29 08:50:27',
            ),
            11 => 
            array (
                'permission_id' => 7,
                'menu_id' => 21,
                'created_at' => '2024-01-30 07:36:43',
                'updated_at' => '2024-01-30 07:36:43',
            ),
        ));
        
        
    }
}