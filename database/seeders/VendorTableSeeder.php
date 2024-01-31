<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendor')->delete();
        
        \DB::table('vendor')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '鸿聚强',
                'contactor' => '',
                'phone' => '',
                'address_full' => '',
                'deleted_at' => NULL,
                'created_at' => '2024-01-30 02:07:34',
                'updated_at' => '2024-01-30 02:07:34',
            ),
        ));
        
        
    }
}