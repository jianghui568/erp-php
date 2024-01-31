<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_roles')->delete();
        
        \DB::table('admin_roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-23 06:25:56',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '老板',
                'slug' => '老板',
                'created_at' => '2024-01-29 02:03:27',
                'updated_at' => '2024-01-29 02:03:27',
            ),
        ));
        
        
    }
}