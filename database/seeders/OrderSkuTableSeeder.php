<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrderSkuTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('order_sku')->delete();
        
        
        
    }
}