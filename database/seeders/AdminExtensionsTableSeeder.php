<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminExtensionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admin_extensions')->delete();
        
        \DB::table('admin_extensions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'abbotton.dcat-sku-plus',
                'version' => '1.0.0',
                'is_enabled' => 1,
                'options' => NULL,
                'created_at' => '2024-01-24 06:15:46',
                'updated_at' => '2024-01-24 06:48:27',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'lty5240.dcat-easy-sku',
                'version' => '1.1.0',
                'is_enabled' => 1,
                'options' => NULL,
                'created_at' => '2024-01-24 06:54:10',
                'updated_at' => '2024-01-24 06:54:16',
            ),
        ));
        
        
    }
}