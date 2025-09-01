<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataBreakingNewsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('breaking_news')->truncate();
        
        DB::table('breaking_news')->insert(array (
            0 => 
            array (
                'id' => 2,
                'language_id' => 1,
                'news_id' => 34,
                'title' => '{"news_title":"Shakil makes history as youngest \\u2018Sea to Summit Everest\\u2019 conqueror","url":"shakil-makes-history-as-youngest-sea-to-summit-everest-conqueror"}',
                'time_stamp' => 1753012659,
                'status' => 1,
                'created_at' => '2025-05-19 18:00:14',
                'updated_at' => '2025-07-20 23:57:39',
            ),
            1 => 
            array (
                'id' => 3,
                'language_id' => 1,
                'news_id' => NULL,
                'title' => '{"news_title":"The bold move to a flexible exchange rate regime","url":""}',
                'time_stamp' => 1747678809,
                'status' => 1,
                'created_at' => '2025-05-19 18:20:09',
                'updated_at' => '2025-05-19 18:20:09',
            ),
            2 => 
            array (
                'id' => 4,
                'language_id' => 3,
                'news_id' => NULL,
                'title' => '{"news_title":"Anu Muhammad questions interim govt sincerity","url":""}',
                'time_stamp' => 1747678839,
                'status' => 1,
                'created_at' => '2025-05-19 18:20:39',
                'updated_at' => '2025-05-19 18:20:39',
            ),
            3 => 
            array (
                'id' => 10,
                'language_id' => 1,
                'news_id' => 95,
                'title' => '{"news_title":"NBA Finals Game 1: Pacers Stun Thunder with Haliburton\'s Buzzer-Beater","url":"nba-finals-game-1-pacers-stun-thunder-with-haliburtons-buzzer-beater"}',
                'time_stamp' => 1753005721,
                'status' => 1,
                'created_at' => '2025-06-08 03:38:25',
                'updated_at' => '2025-07-20 22:02:01',
            ),
            4 => 
            array (
                'id' => 11,
                'language_id' => 3,
                'news_id' => NULL,
                'title' => '{"news_title":"Lorem ipsum dolor sit amet consectetur adipiscing elit ornare, dapibus litora aptent ac faucibus arabic","url":""}',
                'time_stamp' => 1750099881,
                'status' => 1,
                'created_at' => '2025-06-17 00:51:21',
                'updated_at' => '2025-06-17 00:51:21',
            ),
            5 => 
            array (
                'id' => 14,
                'language_id' => 3,
                'news_id' => 99,
                'title' => '{"news_title":"\\u0642\\u0635\\u0641 \\u0625\\u0633\\u0631\\u0627\\u0626\\u064a\\u0644\\u064a \\u064a\\u0648\\u062f\\u064a \\u0628\\u062d\\u064a\\u0627\\u0629 \\u0627\\u0644\\u0639\\u0634\\u0631\\u0627\\u062a \\u0645\\u0646 \\u0645\\u064f\\u0646\\u062a\\u0638\\u0631\\u064a \\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0627\\u062a \\u062c\\u0646\\u0648\\u0628 \\u0642\\u0637\\u0627\\u0639 \\u063a\\u0632\\u0629","url":"https:\\/\\/latestnews365.bdtask-demo.cominternational-ar\\/details\\/97\\/\\u0642\\u0635\\u0641-\\u0625\\u0633\\u0631\\u0627\\u0626\\u064a\\u0644\\u064a-\\u064a\\u0648\\u062f\\u064a-\\u0628\\u062d\\u064a\\u0627\\u0629-\\u0627\\u0644\\u0639\\u0634\\u0631\\u0627\\u062a-\\u0645\\u0646-\\u0645\\u064f\\u0646\\u062a\\u0638\\u0631\\u064a-\\u0627\\u0644\\u0645\\u0633\\u0627\\u0639\\u062f\\u0627\\u062a-\\u062c\\u0646\\u0648\\u0628-\\u0642\\u0637\\u0627\\u0639-\\u063a\\u0632\\u0629"}',
                'time_stamp' => 1751116865,
                'status' => 1,
                'created_at' => '2025-06-18 00:55:31',
                'updated_at' => '2025-06-29 01:21:05',
            ),
            6 => 
            array (
                'id' => 17,
                'language_id' => 17,
                'news_id' => 115,
                'title' => '{"news_title":"\\u0987\\u0989\\u0995\\u09cd\\u09b0\\u09c7\\u09a8 \\u09af\\u09c1\\u09a6\\u09cd\\u09a7\\u09c7\\u09b0 \\u09ae\\u09be\\u099d\\u09c7 \\u09b6\\u09be\\u09a8\\u09cd\\u09a4\\u09bf \\u0986\\u09b2\\u09cb\\u099a\\u09a8\\u09be \\u099c\\u09cb\\u09b0\\u09be\\u09b2\\u09cb \\u0995\\u09b0\\u09a4\\u09c7 \\u0987\\u0989\\u09b0\\u09cb\\u09aa\\u09c0\\u09af\\u09bc \\u09a8\\u09c7\\u09a4\\u09be\\u09a6\\u09c7\\u09b0 \\u09ac\\u09c8\\u09a0\\u0995","url":"https:\\/\\/latestnews365.bdtask-demo.cominternationalnews\\/details\\/115\\/\\u0987\\u0989\\u0995\\u09cd\\u09b0\\u09c7\\u09a8-\\u09af\\u09c1\\u09a6\\u09cd\\u09a7\\u09c7\\u09b0-\\u09ae\\u09be\\u099d\\u09c7-\\u09b6\\u09be\\u09a8\\u09cd\\u09a4\\u09bf-\\u0986\\u09b2\\u09cb\\u099a\\u09a8\\u09be-\\u099c\\u09cb\\u09b0\\u09be\\u09b2\\u09cb-\\u0995\\u09b0\\u09a4\\u09c7-\\u0987\\u0989\\u09b0\\u09cb\\u09aa\\u09c0\\u09af\\u09bc-\\u09a8\\u09c7\\u09a4\\u09be\\u09a6\\u09c7\\u09b0-\\u09ac\\u09c8\\u09a0\\u0995"}',
                'time_stamp' => 1750844894,
                'status' => 1,
                'created_at' => '2025-06-25 21:48:14',
                'updated_at' => '2025-06-25 21:48:14',
            ),
            7 => 
            array (
                'id' => 18,
                'language_id' => 17,
                'news_id' => 116,
                'title' => '{"news_title":"\\u09a8\\u09a4\\u09c1\\u09a8 \\u099c\\u09cb\\u099f \\u0997\\u09a0\\u09a8\\u09c7\\u09b0 \\u0998\\u09cb\\u09b7\\u09a3\\u09be \\u09a6\\u09bf\\u09b2 \\u09aa\\u09cd\\u09b0\\u09a7\\u09be\\u09a8 \\u09a4\\u09bf\\u09a8 \\u09ac\\u09bf\\u09b0\\u09cb\\u09a7\\u09c0 \\u09a6\\u09b2","url":"https:\\/\\/latestnews365.bdtask-demo.comrajniti\\/details\\/116\\/\\u09a8\\u09a4\\u09c1\\u09a8-\\u099c\\u09cb\\u099f-\\u0997\\u09a0\\u09a8\\u09c7\\u09b0-\\u0998\\u09cb\\u09b7\\u09a3\\u09be-\\u09a6\\u09bf\\u09b2-\\u09aa\\u09cd\\u09b0\\u09a7\\u09be\\u09a8-\\u09a4\\u09bf\\u09a8-\\u09ac\\u09bf\\u09b0\\u09cb\\u09a7\\u09c0-\\u09a6\\u09b2"}',
                'time_stamp' => 1750848822,
                'status' => 1,
                'created_at' => '2025-06-25 22:53:42',
                'updated_at' => '2025-06-25 22:53:42',
            ),
            8 => 
            array (
                'id' => 19,
                'language_id' => 17,
                'news_id' => 125,
                'title' => '{"news_title":"\\u09e7\\u09eb \\u0986\\u0997\\u09b8\\u09cd\\u099f \\u09aa\\u09b0\\u09cd\\u09af\\u09a8\\u09cd\\u09a4 \\u0995\\u09cb\\u099a\\u09bf\\u0982 \\u09b8\\u09c7\\u09a8\\u09cd\\u099f\\u09be\\u09b0 \\u09ac\\u09a8\\u09cd\\u09a7 \\u09b0\\u09be\\u0996\\u09be\\u09b0 \\u0998\\u09cb\\u09b7\\u09a3\\u09be \\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be \\u09ae\\u09a8\\u09cd\\u09a4\\u09cd\\u09b0\\u09a3\\u09be\\u09b2\\u09df\\u09c7\\u09b0","url":"https:\\/\\/latestnews365.bdtask-demo.comeducation-news\\/details\\/125\\/\\u09e7\\u09eb-\\u0986\\u0997\\u09b8\\u09cd\\u099f-\\u09aa\\u09b0\\u09cd\\u09af\\u09a8\\u09cd\\u09a4-\\u0995\\u09cb\\u099a\\u09bf\\u0982-\\u09b8\\u09c7\\u09a8\\u09cd\\u099f\\u09be\\u09b0-\\u09ac\\u09a8\\u09cd\\u09a7-\\u09b0\\u09be\\u0996\\u09be\\u09b0-\\u0998\\u09cb\\u09b7\\u09a3\\u09be-\\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be-\\u09ae\\u09a8\\u09cd\\u09a4\\u09cd\\u09b0\\u09a3\\u09be\\u09b2\\u09df\\u09c7\\u09b0"}',
                'time_stamp' => 1750855760,
                'status' => 1,
                'created_at' => '2025-06-26 00:49:20',
                'updated_at' => '2025-06-26 00:49:20',
            ),
            9 => 
            array (
                'id' => 20,
                'language_id' => 17,
                'news_id' => 129,
                'title' => '{"news_title":"\\u09aa\\u09cd\\u09b0\\u09af\\u09c1\\u0995\\u09cd\\u09a4\\u09bf\\u09a8\\u09bf\\u09b0\\u09cd\\u09ad\\u09b0 \\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be: \\u09b8\\u09c1\\u09af\\u09cb\\u0997\\u09c7\\u09b0 \\u099a\\u09c7\\u09df\\u09c7 \\u099a\\u09cd\\u09af\\u09be\\u09b2\\u09c7\\u099e\\u09cd\\u099c \\u09ac\\u09c7\\u09b6\\u09bf?","url":"https:\\/\\/latestnews365.bdtask-demo.comeducation-news\\/details\\/129\\/\\u09aa\\u09cd\\u09b0\\u09af\\u09c1\\u0995\\u09cd\\u09a4\\u09bf\\u09a8\\u09bf\\u09b0\\u09cd\\u09ad\\u09b0-\\u09b6\\u09bf\\u0995\\u09cd\\u09b7\\u09be-\\u09b8\\u09c1\\u09af\\u09cb\\u0997\\u09c7\\u09b0-\\u099a\\u09c7\\u09df\\u09c7-\\u099a\\u09cd\\u09af\\u09be\\u09b2\\u09c7\\u099e\\u09cd\\u099c-\\u09ac\\u09c7\\u09b6\\u09bf?"}',
                'time_stamp' => 1750921443,
                'status' => 1,
                'created_at' => '2025-06-26 19:04:03',
                'updated_at' => '2025-06-26 19:04:03',
            ),
            10 => 
            array (
                'id' => 21,
                'language_id' => 17,
                'news_id' => 161,
                'title' => '{"news_title":"\\u09ac\\u09be\\u09dc\\u099b\\u09c7 \\u09b6\\u09bf\\u09b6\\u09c1\\u09a6\\u09c7\\u09b0 \\u09ae\\u09a7\\u09cd\\u09af\\u09c7 \\u09b9\\u09be\\u0981\\u09aa\\u09be\\u09a8\\u09bf\\u09b0 \\u09aa\\u09cd\\u09b0\\u0995\\u09cb\\u09aa, \\u099a\\u09bf\\u0995\\u09bf\\u09ce\\u09b8\\u0995\\u09b0\\u09be \\u09ac\\u09b2\\u099b\\u09c7\\u09a8 \\u09a6\\u09c2\\u09b7\\u09a3 \\u09a6\\u09be\\u09df\\u09c0","url":"https:\\/\\/latestnews365.bdtask-demo.comhealth-news\\/details\\/161\\/\\u09ac\\u09be\\u09dc\\u099b\\u09c7-\\u09b6\\u09bf\\u09b6\\u09c1\\u09a6\\u09c7\\u09b0-\\u09ae\\u09a7\\u09cd\\u09af\\u09c7-\\u09b9\\u09be\\u0981\\u09aa\\u09be\\u09a8\\u09bf\\u09b0-\\u09aa\\u09cd\\u09b0\\u0995\\u09cb\\u09aa-\\u099a\\u09bf\\u0995\\u09bf\\u09ce\\u09b8\\u0995\\u09b0\\u09be-\\u09ac\\u09b2\\u099b\\u09c7\\u09a8-\\u09a6\\u09c2\\u09b7\\u09a3-\\u09a6\\u09be\\u09df\\u09c0"}',
                'time_stamp' => 1751087561,
                'status' => 1,
                'created_at' => '2025-06-28 17:12:41',
                'updated_at' => '2025-06-28 17:12:41',
            ),
            11 => 
            array (
                'id' => 22,
                'language_id' => 3,
                'news_id' => 237,
                'title' => '{"news_title":"\\u0627\\u0644\\u0623\\u0631\\u062c\\u0646\\u062a\\u064a\\u0646 \\u062a\\u062a\\u0648\\u062c \\u0628\\u0637\\u0644\\u0629 \\u0643\\u0648\\u0628\\u0627 \\u0623\\u0645\\u0631\\u064a\\u0643\\u0627 \\u0628\\u0639\\u062f \\u0641\\u0648\\u0632 \\u0645\\u062b\\u064a\\u0631 \\u0641\\u064a \\u0627\\u0644\\u0646\\u0647\\u0627\\u0626\\u064a","url":"https:\\/\\/latestnews365.bdtask-demo.com\\u0627\\u0644\\u0631\\u064a\\u0627\\u0636\\u0629\\/details\\/237\\/\\u0627\\u0644\\u0623\\u0631\\u062c\\u0646\\u062a\\u064a\\u0646-\\u062a\\u062a\\u0648\\u062c-\\u0628\\u0637\\u0644\\u0629-\\u0643\\u0648\\u0628\\u0627-\\u0623\\u0645\\u0631\\u064a\\u0643\\u0627-\\u0628\\u0639\\u062f-\\u0641\\u0648\\u0632-\\u0645\\u062b\\u064a\\u0631-\\u0641\\u064a-\\u0627\\u0644\\u0646\\u0647\\u0627\\u0626\\u064a"}',
                'time_stamp' => 1751114096,
                'status' => 1,
                'created_at' => '2025-06-29 00:34:56',
                'updated_at' => '2025-06-29 00:34:56',
            ),
            12 => 
            array (
                'id' => 23,
                'language_id' => 3,
                'news_id' => 241,
                'title' => '{"news_title":"\\u0646\\u0648\\u0641\\u0627\\u0643 \\u062f\\u064a\\u0648\\u0643\\u0648\\u0641\\u064a\\u062a\\u0634 \\u064a\\u0639\\u0644\\u0646 \\u0627\\u0639\\u062a\\u0632\\u0627\\u0644\\u0647 \\u0628\\u0639\\u062f \\u0628\\u0637\\u0648\\u0644\\u0629 \\u0648\\u064a\\u0645\\u0628\\u0644\\u062f\\u0648\\u0646 2025","url":"https:\\/\\/latestnews365.bdtask-demo.comsport\\/details\\/241\\/\\u0646\\u0648\\u0641\\u0627\\u0643-\\u062f\\u064a\\u0648\\u0643\\u0648\\u0641\\u064a\\u062a\\u0634-\\u064a\\u0639\\u0644\\u0646-\\u0627\\u0639\\u062a\\u0632\\u0627\\u0644\\u0647-\\u0628\\u0639\\u062f-\\u0628\\u0637\\u0648\\u0644\\u0629-\\u0648\\u064a\\u0645\\u0628\\u0644\\u062f\\u0648\\u0646"}',
                'time_stamp' => 1751115461,
                'status' => 1,
                'created_at' => '2025-06-29 00:57:41',
                'updated_at' => '2025-06-29 00:57:41',
            ),
            13 => 
            array (
                'id' => 24,
                'language_id' => 3,
                'news_id' => 254,
                'title' => '{"news_title":"\\u0645\\u062a\\u062d\\u0641 \\u0631\\u0642\\u0645\\u064a \\u062c\\u062f\\u064a\\u062f \\u064a\\u0648\\u062b\\u0642 \\u062a\\u0627\\u0631\\u064a\\u062e \\u0627\\u0644\\u0641\\u0646\\u0648\\u0646 \\u0627\\u0644\\u0639\\u0631\\u0628\\u064a\\u0629 \\u0645\\u0646 \\u0627\\u0644\\u0639\\u0635\\u0648\\u0631 \\u0627\\u0644\\u0642\\u062f\\u064a\\u0645\\u0629 \\u062d\\u062a\\u0649 \\u0627\\u0644\\u064a\\u0648\\u0645","url":"https:\\/\\/latestnews365.bdtask-demo.comculture-ar\\/details\\/254\\/\\u0645\\u062a\\u062d\\u0641-\\u0631\\u0642\\u0645\\u064a-\\u062c\\u062f\\u064a\\u062f-\\u064a\\u0648\\u062b\\u0642-\\u062a\\u0627\\u0631\\u064a\\u062e-\\u0627\\u0644\\u0641\\u0646\\u0648\\u0646-\\u0627\\u0644\\u0639\\u0631\\u0628\\u064a\\u0629-\\u0645\\u0646-\\u0627\\u0644\\u0639\\u0635\\u0648\\u0631-\\u0627\\u0644\\u0642\\u062f\\u064a\\u0645\\u0629-\\u062d\\u062a\\u0649-\\u0627\\u0644\\u064a\\u0648\\u0645"}',
                'time_stamp' => 1751121191,
                'status' => 1,
                'created_at' => '2025-06-29 02:33:11',
                'updated_at' => '2025-06-29 02:33:11',
            ),
            14 => 
            array (
                'id' => 25,
                'language_id' => 1,
                'news_id' => 324,
                'title' => '{"news_title":"Armed Robbery at QuickMart Leaves Community on Edge","url":"armed-robbery-at-quickmart-leaves-community-on-edge"}',
                'time_stamp' => 1752470095,
                'status' => 1,
                'created_at' => '2025-07-14 17:14:55',
                'updated_at' => '2025-07-14 17:14:55',
            ),
            15 => 
            array (
                'id' => 26,
                'language_id' => 3,
                'news_id' => 344,
                'title' => '{"news_title":"\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629\\u060c \\u0648\\u0642\\u0627\\u062f \\u0641\\u0631\\u064a\\u0642\\u0647 \\u0628\\u062b\\u0642\\u0629 \\u0648\\u062b\\u0628\\u0627\\u062a \\u0646\\u062d\\u0648 \\u0627\\u0644\\u0644\\u0642\\u0628 \\u0627\\u0644\\u0630\\u0647\\u0628\\u064a \\u0648\\u0633\\u0637 \\u062a\\u0635\\u0641\\u064a\\u0642 \\u0627\\u0644\\u062c\\u0645\\u0627\\u0647\\u064a\\u0631 \\u0627\\u0644\\u0641\\u0631\\u0646\\u0633\\u064a\\u0629 \\u0627\\u0644\\u062a\\u064a \\u0627\\u062d\\u062a\\u0641\\u0644\\u062a \\u0628\\u0647\\u0630\\u0627 \\u0627\\u0644\\u0625\\u0646\\u062c\\u0627\\u0632 \\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\\u064a","url":"\\u0645\\u062a\\u0627\\u0628\\u0639\\u0629-\\u0648\\u0642\\u0627\\u062f-\\u0641\\u0631\\u064a\\u0642\\u0647-\\u0628\\u062b\\u0642\\u0629-\\u0648\\u062b\\u0628\\u0627\\u062a-\\u0646\\u062d\\u0648-\\u0627\\u0644\\u0644\\u0642\\u0628-\\u0627\\u0644\\u0630\\u0647\\u0628\\u064a-\\u0648\\u0633\\u0637-\\u062a\\u0635\\u0641\\u064a\\u0642-\\u0627\\u0644\\u062c\\u0645\\u0627\\u0647\\u064a\\u0631-\\u0627\\u0644\\u0641\\u0631\\u0646\\u0633\\u064a\\u0629-\\u0627\\u0644\\u062a\\u064a-\\u0627\\u062d\\u062a\\u0641\\u0644\\u062a-\\u0628\\u0647\\u0630\\u0627-\\u0627\\u0644\\u0625\\u0646\\u062c\\u0627\\u0632-\\u0627\\u0644\\u062a\\u0627\\u0631\\u064a\\u062e\\u064a"}',
                'time_stamp' => 1753022501,
                'status' => 1,
                'created_at' => '2025-07-21 02:38:57',
                'updated_at' => '2025-07-21 02:41:41',
            ),
            16 => 
            array (
                'id' => 27,
                'language_id' => 3,
                'news_id' => 345,
                'title' => '{"news_title":"\\u0648\\u064a\\u0639\\u062f \\u0647\\u0630\\u0627 \\u0627\\u0644\\u062a\\u062a\\u0648\\u064a\\u062c \\u0647\\u0648 \\u0627\\u0644\\u0623\\u0648\\u0644 \\u0645\\u0646 \\u0646\\u0648\\u0639\\u0647 \\u0644\\u0641\\u0631\\u0646\\u0633\\u0627 \\u0641\\u064a \\u0643\\u0631\\u0629 \\u0627\\u0644\\u0633\\u0644\\u0629 \\u0644\\u0644\\u0631\\u062c\\u0627\\u0644 \\u0641\\u064a \\u062a\\u0627\\u0631\\u064a\\u062e \\u0645\\u0634\\u0627\\u0631\\u0643\\u0627\\u062a\\u0647\\u0627","url":"\\u0648\\u064a\\u0639\\u062f-\\u0647\\u0630\\u0627-\\u0627\\u0644\\u062a\\u062a\\u0648\\u064a\\u062c-\\u0647\\u0648-\\u0627\\u0644\\u0623\\u0648\\u0644-\\u0645\\u0646-\\u0646\\u0648\\u0639\\u0647-\\u0644\\u0641\\u0631\\u0646\\u0633\\u0627-\\u0641\\u064a-\\u0643\\u0631\\u0629-\\u0627\\u0644\\u0633\\u0644\\u0629-\\u0644\\u0644\\u0631\\u062c\\u0627\\u0644-\\u0641\\u064a-\\u062a\\u0627\\u0631\\u064a\\u062e-\\u0645\\u0634\\u0627\\u0631\\u0643\\u0627\\u062a\\u0647\\u0627"}',
                'time_stamp' => 1753022487,
                'status' => 1,
                'created_at' => '2025-07-21 02:40:07',
                'updated_at' => '2025-07-21 02:41:27',
            ),
            17 => 
            array (
                'id' => 28,
                'language_id' => 1,
                'news_id' => NULL,
                'title' => '{"news_title":"French President Macron signaled intent to formally recognize Palestine","url":""}',
                'time_stamp' => 1753522180,
                'status' => 1,
                'created_at' => '2025-07-26 21:29:40',
                'updated_at' => '2025-07-26 21:29:40',
            ),
            18 => 
            array (
                'id' => 29,
                'language_id' => 1,
                'news_id' => NULL,
                'title' => '{"news_title":"A federal judge issued an injunction against the Trump administration\\u2019s","url":""}',
                'time_stamp' => 1753522305,
                'status' => 1,
                'created_at' => '2025-07-26 21:31:45',
                'updated_at' => '2025-07-26 21:31:45',
            ),
            19 => 
            array (
                'id' => 30,
                'language_id' => 1,
                'news_id' => 348,
                'title' => '{"news_title":"The United States has long been known as a nation of immigrants and diversity","url":"the-united-states-has-long-been-known-as-a-nation-of-immigrants-and-diversity"}',
                'time_stamp' => 1753531411,
                'status' => 1,
                'created_at' => '2025-07-27 00:00:37',
                'updated_at' => '2025-07-27 00:03:31',
            ),
            20 => 
            array (
                'id' => 31,
                'language_id' => 3,
                'news_id' => 350,
                'title' => '{"news_title":"\\u0648\\u0645\\u0646 \\u0627\\u0644\\u062c\\u062f\\u064a\\u0631 \\u0628\\u0627\\u0644\\u0630\\u0643\\u0631 \\u0623\\u0646 \\u0645\\u062f\\u064a\\u0646\\u0629 \\u062f\\u0643\\u0627\\u060c \\u0648\\u0627\\u0644\\u062a\\u064a \\u062a\\u0639\\u062a\\u0628\\u0631 \\u0648\\u0627\\u062d\\u062f\\u0629 \\u0645\\u0646 \\u0623\\u0643\\u062b\\u0631 \\u0627\\u0644\\u0645\\u062f\\u0646 \\u0643\\u062b\\u0627\\u0641\\u0629 \\u0633\\u0643\\u0627\\u0646\\u064a\\u0629 \\u0641\\u064a \\u0627\\u0644\\u0639\\u0627\\u0644\\u0645\\u060c \\u062a\\u0639\\u0627\\u0646\\u064a","url":"\\u0648\\u0645\\u0646-\\u0627\\u0644\\u062c\\u062f\\u064a\\u0631-\\u0628\\u0627\\u0644\\u0630\\u0643\\u0631-\\u0623\\u0646-\\u0645\\u062f\\u064a\\u0646\\u0629-\\u062f\\u0643\\u0627-\\u0648\\u0627\\u0644\\u062a\\u064a-\\u062a\\u0639\\u062a\\u0628\\u0631-\\u0648\\u0627\\u062d\\u062f\\u0629-\\u0645\\u0646-\\u0623\\u0643\\u062b\\u0631-\\u0627\\u0644\\u0645\\u062f\\u0646-\\u0643\\u062b\\u0627\\u0641\\u0629-\\u0633\\u0643\\u0627\\u0646\\u064a\\u0629-\\u0641\\u064a-\\u0627\\u0644\\u0639\\u0627\\u0644\\u0645-\\u062a\\u0639\\u0627\\u0646\\u064a"}',
                'time_stamp' => 1753536857,
                'status' => 1,
                'created_at' => '2025-07-27 01:34:17',
                'updated_at' => '2025-07-27 01:34:17',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
}