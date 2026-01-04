<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataHomePagePositionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('home_page_positions')->truncate();
        
        DB::table('home_page_positions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'language_id' => 1,
                'position_no' => 1,
                'cat_name' => 'Politics',
                'slug' => 'politics',
                'max_news' => NULL,
                'category_id' => 45,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            1 => 
            array (
                'id' => 2,
                'language_id' => 1,
                'position_no' => 2,
                'cat_name' => 'Sports',
                'slug' => 'sports',
                'max_news' => NULL,
                'category_id' => 11,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            2 => 
            array (
                'id' => 3,
                'language_id' => 1,
                'position_no' => 3,
                'cat_name' => 'International News',
                'slug' => 'international-news',
                'max_news' => NULL,
                'category_id' => 48,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            3 => 
            array (
                'id' => 4,
                'language_id' => 1,
                'position_no' => 4,
                'cat_name' => 'Business',
                'slug' => 'business',
                'max_news' => NULL,
                'category_id' => 51,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            4 => 
            array (
                'id' => 5,
                'language_id' => 1,
                'position_no' => 5,
                'cat_name' => 'Fashion',
                'slug' => 'fashion',
                'max_news' => NULL,
                'category_id' => 57,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            5 => 
            array (
                'id' => 6,
                'language_id' => 1,
                'position_no' => 6,
                'cat_name' => 'Health',
                'slug' => 'health',
                'max_news' => NULL,
                'category_id' => 18,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            6 => 
            array (
                'id' => 7,
                'language_id' => 1,
                'position_no' => 7,
                'cat_name' => 'Travel',
                'slug' => 'travel',
                'max_news' => NULL,
                'category_id' => 56,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            7 => 
            array (
                'id' => 8,
                'language_id' => 1,
                'position_no' => 8,
                'cat_name' => 'Food',
                'slug' => 'food-news',
                'max_news' => NULL,
                'category_id' => 87,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            8 => 
            array (
                'id' => 9,
                'language_id' => 1,
                'position_no' => 9,
                'cat_name' => 'Life Style',
                'slug' => 'life-style',
                'max_news' => NULL,
                'category_id' => 55,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            9 => 
            array (
                'id' => 10,
                'language_id' => 3,
                'position_no' => 1,
                'cat_name' => 'الأخبار الدولية',
                'slug' => 'international-ar',
                'max_news' => NULL,
                'category_id' => 78,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            10 => 
            array (
                'id' => 11,
                'language_id' => 3,
                'position_no' => 2,
                'cat_name' => 'المنوعات والترفيه',
                'slug' => 'lifestyle',
                'max_news' => NULL,
                'category_id' => 85,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            11 => 
            array (
                'id' => 12,
                'language_id' => 3,
                'position_no' => 3,
                'cat_name' => 'رياضة',
                'slug' => 'sport',
                'max_news' => NULL,
                'category_id' => 54,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            12 => 
            array (
                'id' => 13,
                'language_id' => 3,
                'position_no' => 4,
                'cat_name' => 'الثقافة والفنون',
                'slug' => 'culture-ar',
                'max_news' => NULL,
                'category_id' => 82,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            13 => 
            array (
                'id' => 14,
                'language_id' => 3,
                'position_no' => 5,
                'cat_name' => 'الأخبار المحلية',
                'slug' => 'local-news-ar',
                'max_news' => NULL,
                'category_id' => 77,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            14 => 
            array (
                'id' => 15,
                'language_id' => 3,
                'position_no' => 6,
                'cat_name' => 'الاقتصاد والأعمال',
                'slug' => 'economy-ar',
                'max_news' => NULL,
                'category_id' => 80,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            15 => 
            array (
                'id' => 16,
                'language_id' => 3,
                'position_no' => 7,
                'cat_name' => 'العلوم والتكنولوجيا',
                'slug' => 'science-ar',
                'max_news' => NULL,
                'category_id' => 83,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            16 => 
            array (
                'id' => 17,
                'language_id' => 3,
                'position_no' => 8,
                'cat_name' => 'الثقافة والفنون',
                'slug' => 'culture-ar',
                'max_news' => NULL,
                'category_id' => 82,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            17 => 
            array (
                'id' => 18,
                'language_id' => 3,
                'position_no' => 9,
                'cat_name' => 'السياسة',
                'slug' => 'politics-ar',
                'max_news' => NULL,
                'category_id' => 79,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            18 => 
            array (
                'id' => 19,
                'language_id' => 17,
                'position_no' => 1,
                'cat_name' => 'রাজনীতি',
                'slug' => 'rajniti',
                'max_news' => NULL,
                'category_id' => 62,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            19 => 
            array (
                'id' => 20,
                'language_id' => 17,
                'position_no' => 2,
                'cat_name' => 'আন্তর্জাতিক',
                'slug' => 'internationalnews',
                'max_news' => NULL,
                'category_id' => 63,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            20 => 
            array (
                'id' => 21,
                'language_id' => 17,
                'position_no' => 3,
                'cat_name' => 'খেলা',
                'slug' => 'khela',
                'max_news' => NULL,
                'category_id' => 65,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            21 => 
            array (
                'id' => 22,
                'language_id' => 17,
                'position_no' => 4,
                'cat_name' => 'অর্থনীতি',
                'slug' => 'economy',
                'max_news' => NULL,
                'category_id' => 64,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            22 => 
            array (
                'id' => 23,
                'language_id' => 17,
                'position_no' => 5,
                'cat_name' => 'প্রযুক্তি',
                'slug' => 'projukti',
                'max_news' => NULL,
                'category_id' => 67,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            23 => 
            array (
                'id' => 24,
                'language_id' => 17,
                'position_no' => 6,
                'cat_name' => 'অপরাধ',
                'slug' => 'oporadh',
                'max_news' => NULL,
                'category_id' => 70,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            24 => 
            array (
                'id' => 25,
                'language_id' => 17,
                'position_no' => 7,
                'cat_name' => 'লাইফস্টাইল',
                'slug' => 'lifestyle-news',
                'max_news' => NULL,
                'category_id' => 69,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            25 => 
            array (
                'id' => 26,
                'language_id' => 17,
                'position_no' => 8,
                'cat_name' => 'স্বাস্থ্য',
                'slug' => 'health-news',
                'max_news' => NULL,
                'category_id' => 66,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
            26 => 
            array (
                'id' => 27,
                'language_id' => 17,
                'position_no' => 9,
                'cat_name' => 'কৃষি ও জলবায়ু',
                'slug' => 'climate-news',
                'max_news' => NULL,
                'category_id' => 71,
                'status' => 1,
                'created_at' => '2025-07-27 01:29:29',
                'updated_at' => '2025-07-27 01:29:29',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}