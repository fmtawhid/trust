<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataNewsCommentRepliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('news_comment_replies')->truncate();
        
        DB::table('news_comment_replies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'news_comment_id' => 2,
                'web_user_id' => 12,
                'reply' => 'Teplsdfs',
                'is_approved' => 0,
                'created_at' => '2025-06-18 00:58:12',
                'updated_at' => '2025-06-18 00:58:12',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}