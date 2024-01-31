<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_users')->delete();
        
        \DB::table('admin_users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'password' => '$2y$12$WBLwVqUx0G5aoe9wcRicL.UnYJYfw65rBfGZXe7F97rtXEbvGwUeq',
                'name' => 'Administrator',
                'avatar' => NULL,
                'remember_token' => 'J4SFpVvmvKld6Jo4wnqZGKJI3jLDA0EYYzRDnfGJzVTctdTOhlimestL5FnP',
                'created_at' => '2024-01-23 06:25:55',
                'updated_at' => '2024-01-23 06:25:56',
            ),
            1 => 
            array (
                'id' => 2,
                'username' => 'H',
                'password' => '$2y$10$cTMDv05g4tMxwF5fwkX4oOoawY1z51d3ktPyxEWgwYv3xdf/w9O.K',
                'name' => 'H',
                'avatar' => NULL,
                'remember_token' => NULL,
                'created_at' => '2024-01-29 02:01:06',
                'updated_at' => '2024-01-29 02:01:06',
            ),
        ));
        
        
    }
}