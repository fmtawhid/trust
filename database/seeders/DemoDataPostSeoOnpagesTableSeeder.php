<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataPostSeoOnpagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('post_seo_onpages')->truncate();
        
        DB::table('post_seo_onpages')->insert(array (
            0 => 
            array (
                'id' => 5,
                'news_id' => 138,
                'meta_keyword' => 'প্রযুক্তির ভবিষ্যৎ',
                'meta_description' => 'আগামী ১০ বছরে প্রযুক্তি আমাদের জীবন কীভাবে বদলে দেবে? জানুন AI, 6G, স্বাস্থ্য ও শিক্ষার ভবিষ্যৎ এই বিশ্লেষণে।',
                'created_at' => '2025-06-26 20:15:13',
                'updated_at' => '2025-06-26 20:15:13',
            ),
            1 => 
            array (
                'id' => 6,
                'news_id' => 140,
                'meta_keyword' => 'ছাত্র জীবনে টাইম ম্যানেজমেন্ট',
                'meta_description' => 'ছাত্র জীবনে কার্যকর টাইম ম্যানেজমেন্ট কিভাবে সফলতার পথে সাহায্য করে জানুন। সময়কে সঠিকভাবে নিয়ন্ত্রণ করে পড়াশোনা ও অন্যান্য কাজের সমন্বয় করার কার্যকর টিপস।',
                'created_at' => '2025-06-26 22:25:50',
                'updated_at' => '2025-06-26 22:25:50',
            ),
            2 => 
            array (
                'id' => 7,
                'news_id' => 141,
                'meta_keyword' => 'learn from messi life',
                'meta_description' => 'লিওনেল মেসির জীবন থেকে শেখার ৫টি গুরুত্বপূর্ণ শিক্ষা যা সফলতা, ধৈর্য্য ও নিষ্ঠার পথে পথপ্রদর্শক হবে। আপনার লক্ষ্য অর্জনে এই শিক্ষাগুলো কাজে লাগান।',
                'created_at' => '2025-06-26 23:51:42',
                'updated_at' => '2025-06-26 23:51:42',
            ),
            3 => 
            array (
                'id' => 8,
                'news_id' => 162,
                'meta_keyword' => 'অনলাইন শিক্ষার ভবিষ্যৎ: ক্লাসরুম কি চিরতরে বদলে যাচ্ছে?',
                'meta_description' => 'অনলাইন শিক্ষার ভবিষ্যৎ: ক্লাসরুম কি চিরতরে বদলে যাচ্ছে?',
                'created_at' => '2025-06-28 17:14:22',
                'updated_at' => '2025-06-28 17:14:22',
            ),
            4 => 
            array (
                'id' => 9,
                'news_id' => 257,
                'meta_keyword' => 'السينما المستقلة العربية تحصد جوائز في مهرجانات دولية',
                'meta_description' => 'السينما المستقلة العربية تحصد جوائز في مهرجانات دولية',
                'created_at' => '2025-06-29 02:09:48',
                'updated_at' => '2025-06-29 02:09:48',
            ),
            5 => 
            array (
                'id' => 11,
                'news_id' => 265,
                'meta_keyword' => 'انتخابات مرتقبة تشعل الجدل في الساحة السياسية',
                'meta_description' => 'انتخابات مرتقبة تشعل الجدل في الساحة السياسية',
                'created_at' => '2025-06-29 02:22:21',
                'updated_at' => '2025-06-29 02:22:21',
            ),
            6 => 
            array (
                'id' => 12,
                'news_id' => 267,
                'meta_keyword' => 'جهود دبلوماسية لإنهاء النزاعات في الشرق الأوسط',
                'meta_description' => 'جهود دبلوماسية لإنهاء النزاعات في الشرق الأوسط',
                'created_at' => '2025-06-29 02:27:24',
                'updated_at' => '2025-06-29 02:27:24',
            ),
            7 => 
            array (
                'id' => 13,
                'news_id' => 269,
                'meta_keyword' => 'هل تعود الحرب الباردة؟ تصاعد التوتر بين القوى الكبرى',
                'meta_description' => 'هل تعود الحرب الباردة؟ تصاعد التوتر بين القوى الكبرى',
                'created_at' => '2025-06-29 02:30:45',
                'updated_at' => '2025-06-29 02:30:45',
            ),
            8 => 
            array (
                'id' => 14,
                'news_id' => 271,
                'meta_keyword' => 'القيادة الجديدة تعد بإصلاحات سياسية واقتصادية جذرية',
                'meta_description' => 'القيادة الجديدة تعد بإصلاحات سياسية واقتصادية جذرية',
                'created_at' => '2025-06-29 02:34:18',
                'updated_at' => '2025-06-29 02:34:18',
            ),
            9 => 
            array (
                'id' => 16,
                'news_id' => 262,
                'meta_keyword' => 'محادثات جديدة بين القادة العرب لحل أزمات المنطقة',
                'meta_description' => 'محادثات جديدة بين القادة العرب لحل أزمات المنطقة',
                'created_at' => '2025-06-29 18:09:31',
                'updated_at' => '2025-06-29 18:09:31',
            ),
            10 => 
            array (
                'id' => 17,
                'news_id' => 273,
                'meta_keyword' => 'الاحتجاجات الشعبية تضغط على صناع القرار لاتخاذ مواقف واضحة',
                'meta_description' => 'الاحتجاجات الشعبية تضغط على صناع القرار لاتخاذ مواقف واضحة',
                'created_at' => '2025-06-29 18:10:07',
                'updated_at' => '2025-06-29 18:10:07',
            ),
            11 => 
            array (
                'id' => 21,
                'news_id' => 282,
                'meta_keyword' => 'Heatwave Grips U.S',
                'meta_description' => 'The ruling stems from charges brought against former President Donald Trump, who has faced multiple indictments related to alleged interference in the 2020 presidential election and events su',
                'created_at' => '2025-07-26 20:26:30',
                'updated_at' => '2025-07-26 20:26:30',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}