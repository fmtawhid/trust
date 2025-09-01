<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataNewsCommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('news_comments')->truncate();
        
        DB::table('news_comments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'news_mst_id' => 75,
                'video_news_id' => NULL,
                'opinion_id' => NULL,
                'web_user_id' => 12,
                'comment' => 'Tessdsd sdfdsf',
                'is_approved' => 0,
                'created_at' => '2025-06-18 00:57:38',
                'updated_at' => '2025-06-18 00:57:38',
            ),
            1 => 
            array (
                'id' => 2,
                'news_mst_id' => NULL,
                'video_news_id' => 28,
                'opinion_id' => NULL,
                'web_user_id' => 12,
                'comment' => 'Teste sdfsd',
                'is_approved' => 0,
                'created_at' => '2025-06-18 00:58:03',
                'updated_at' => '2025-06-18 00:58:03',
            ),
            2 => 
            array (
                'id' => 5,
                'news_mst_id' => 337,
                'video_news_id' => NULL,
                'opinion_id' => NULL,
                'web_user_id' => 22,
                'comment' => 'বহ',
                'is_approved' => 0,
                'created_at' => '2025-07-21 07:13:31',
                'updated_at' => '2025-07-21 07:13:31',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}