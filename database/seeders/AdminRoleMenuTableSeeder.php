<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRoleMenuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_role_menu')->delete();
        
        \DB::table('admin_role_menu')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'menu_id' => 19,
                'created_at' => '2024-01-29 08:08:58',
                'updated_at' => '2024-01-29 08:08:58',
            ),
            1 => 
            array (
                'role_id' => 2,
                'menu_id' => 1,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            2 => 
            array (
                'role_id' => 2,
                'menu_id' => 8,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            3 => 
            array (
                'role_id' => 2,
                'menu_id' => 10,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            4 => 
            array (
                'role_id' => 2,
                'menu_id' => 11,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            5 => 
            array (
                'role_id' => 2,
                'menu_id' => 12,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            6 => 
            array (
                'role_id' => 2,
                'menu_id' => 15,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            7 => 
            array (
                'role_id' => 2,
                'menu_id' => 16,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            8 => 
            array (
                'role_id' => 2,
                'menu_id' => 17,
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
            9 => 
            array (
                'role_id' => 2,
                'menu_id' => 19,
                'created_at' => '2024-01-29 08:08:58',
                'updated_at' => '2024-01-29 08:08:58',
            ),
        ));
        
        
    }
}