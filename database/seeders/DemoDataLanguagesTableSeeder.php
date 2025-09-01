<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataLanguagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('languages')->truncate();
        
        DB::table('languages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'langname' => 'English',
                'value' => 'en',
                'created_at' => '2022-12-08 06:29:24',
                'updated_at' => '2022-12-08 06:29:24',
            ),
            1 => 
            array (
                'id' => 3,
                'langname' => 'Arabic',
                'value' => 'ar',
                'created_at' => '2024-08-04 16:03:42',
                'updated_at' => '2024-08-04 16:03:42',
            ),
            2 => 
            array (
                'id' => 17,
                'langname' => 'Bengali/Bangla',
                'value' => 'bn',
                'created_at' => '2025-06-25 21:25:41',
                'updated_at' => '2025-06-25 21:25:41',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}