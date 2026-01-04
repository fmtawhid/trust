<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataCategoryTopicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('category_topics')->truncate();
        
        DB::table('category_topics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'uuid' => 'd4325a5b-2c03-4c45-aa14-7fcc66762a2c',
                'cat_slug' => 'new-topic',
                'topic' => 'topic-test',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2025-05-11 18:19:29',
                'updated_at' => '2025-05-11 18:51:52',
                'deleted_at' => '2025-05-11 18:51:52',
            ),
            1 => 
            array (
                'id' => 2,
                'uuid' => '2f03e4b8-3be9-43b1-b695-81ff0c728198',
                'cat_slug' => 'new-topic',
                'topic' => 'topic-test',
                'created_by' => 1,
                'updated_by' => NULL,
                'created_at' => '2025-05-11 18:51:53',
                'updated_at' => '2025-05-11 18:57:58',
                'deleted_at' => '2025-05-11 18:57:58',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}