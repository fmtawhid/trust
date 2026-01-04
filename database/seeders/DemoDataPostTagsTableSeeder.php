<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataPostTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('post_tags')->truncate();
        
        DB::table('post_tags')->insert(array (
            0 => 
            array (
                'id' => 3,
                'news_id' => 140,
                'tag' => 'ছাত্র-জীবনে-টাইম-ম্যানেজমেন্ট',
                'created_at' => '2025-06-26 22:25:50',
                'updated_at' => '2025-06-26 22:25:50',
            ),
            1 => 
            array (
                'id' => 4,
                'news_id' => 141,
                'tag' => 'messi',
                'created_at' => '2025-06-26 23:51:42',
                'updated_at' => '2025-06-26 23:51:42',
            ),
            2 => 
            array (
                'id' => 6,
                'news_id' => 142,
                'tag' => 'health',
                'created_at' => '2025-06-27 00:41:13',
                'updated_at' => '2025-06-27 00:41:13',
            ),
            3 => 
            array (
                'id' => 7,
                'news_id' => 162,
                'tag' => 'অনলাইন-শিক্ষার-ভবিষ্যৎ:-ক্লাসরুম-কি-চিরতরে-বদলে-যাচ্ছে?',
                'created_at' => '2025-06-28 17:14:22',
                'updated_at' => '2025-06-28 17:14:22',
            ),
            4 => 
            array (
                'id' => 8,
                'news_id' => 257,
                'tag' => 'السينما-المستقلة-العربية-تحصد-جوائز-في-مهرجانات-دولية',
                'created_at' => '2025-06-29 02:09:48',
                'updated_at' => '2025-06-29 02:09:48',
            ),
            5 => 
            array (
                'id' => 10,
                'news_id' => 265,
                'tag' => 'انتخابات-مرتقبة-تشعل-الجدل-في-الساحة-السياسية',
                'created_at' => '2025-06-29 02:22:21',
                'updated_at' => '2025-06-29 02:22:21',
            ),
            6 => 
            array (
                'id' => 11,
                'news_id' => 267,
                'tag' => 'جهود-دبلوماسية-لإنهاء-النزاعات-في-الشرق-الأوسط',
                'created_at' => '2025-06-29 02:27:24',
                'updated_at' => '2025-06-29 02:27:24',
            ),
            7 => 
            array (
                'id' => 12,
                'news_id' => 269,
                'tag' => 'هل-تعود-الحرب-الباردة؟-تصاعد-التوتر-بين-القوى-الكبرى',
                'created_at' => '2025-06-29 02:30:45',
                'updated_at' => '2025-06-29 02:30:45',
            ),
            8 => 
            array (
                'id' => 13,
                'news_id' => 271,
                'tag' => 'القيادة-الجديدة-تعد-بإصلاحات-سياسية-واقتصادية-جذرية',
                'created_at' => '2025-06-29 02:34:18',
                'updated_at' => '2025-06-29 02:34:18',
            ),
            9 => 
            array (
                'id' => 15,
                'news_id' => 262,
                'tag' => 'محادثات-جديدة-بين-القادة-العرب-لحل-أزمات-المنطقة',
                'created_at' => '2025-06-29 18:09:31',
                'updated_at' => '2025-06-29 18:09:31',
            ),
            10 => 
            array (
                'id' => 16,
                'news_id' => 273,
                'tag' => 'الاحتجاجات-الشعبية-تضغط-على-صناع-القرار-لاتخاذ-مواقف-واضحة',
                'created_at' => '2025-06-29 18:10:07',
                'updated_at' => '2025-06-29 18:10:07',
            ),
            11 => 
            array (
                'id' => 61,
                'news_id' => 337,
                'tag' => 'USA',
                'created_at' => '2025-07-26 20:44:26',
                'updated_at' => '2025-07-26 20:44:26',
            ),
            12 => 
            array (
                'id' => 62,
                'news_id' => 337,
                'tag' => 'POPULATION',
                'created_at' => '2025-07-26 20:44:26',
                'updated_at' => '2025-07-26 20:44:26',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}