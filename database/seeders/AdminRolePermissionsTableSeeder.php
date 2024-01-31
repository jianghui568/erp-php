<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminRolePermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_role_permissions')->delete();
        
        \DB::table('admin_role_permissions')->insert(array (
            0 => 
            array (
                'role_id' => 2,
                'permission_id' => 7,
                'created_at' => '2024-01-29 02:15:41',
                'updated_at' => '2024-01-29 02:15:41',
            ),
        ));
        
        
    }
}