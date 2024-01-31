<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class EntryTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('entry')->delete();
        
        
        
    }
}