<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataWebUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('web_users')->truncate();
        
        DB::table('web_users')->insert(array (
            0 => 
            array (
                'id' => 12,
                'social_id' => '103041799998895693651',
                'name' => 'Bdtask Ltd',
                'email' => 'bdtask.pr17@gmail.com',
                'password' => '',
                'remember_token' => NULL,
                'avatar' => 'avatars/3b748f21-8645-47dd-8ecb-777ec7c72a99.png',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-14 22:41:28',
                'updated_at' => '2025-06-14 22:41:28',
            ),
            1 => 
            array (
                'id' => 13,
                'social_id' => '122114718566879718',
                'name' => 'Shaiful Islam',
                'email' => 'profbdtask@gmail.com',
                'password' => '$2y$10$2t3Ss8DdG8lilJGkXuhYo.OcwKS1Toiu2kS1Yulm6hTMfXjKa2u4W',
                'remember_token' => NULL,
                'avatar' => 'avatars/3b305589-0767-4e4d-bac4-bc3f1e50682b.jpg',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-14 22:42:23',
                'updated_at' => '2025-06-14 22:42:23',
            ),
            2 => 
            array (
                'id' => 14,
                'social_id' => '108287400882201028120',
                'name' => 'StyleDunea',
                'email' => 'styledunea.bd@gmail.com',
                'password' => '',
                'remember_token' => NULL,
                'avatar' => 'avatars/b40bd95f-d14c-4377-854d-c8749d41eeb2.jpg',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-14 23:25:35',
                'updated_at' => '2025-06-14 23:25:35',
            ),
            3 => 
            array (
                'id' => 15,
                'social_id' => '4198263727162981',
                'name' => 'Md Shaiful Islam Shaifullah',
                'email' => 'mdshaifullah81@gmail.com',
                'password' => '$2y$10$CzLp/0QgY/E9fItaKj12bur2PQ8swu7zhUdfk55UYePShRZSiZAZW',
                'remember_token' => NULL,
                'avatar' => 'avatars/466264ed-7ac1-43fc-99f9-0e775f3895f9.jpg',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-15 00:32:19',
                'updated_at' => '2025-06-15 00:32:19',
            ),
            4 => 
            array (
                'id' => 16,
                'social_id' => '1161623892647781',
                'name' => 'Sky Trip',
                'email' => 'bdtasksky@gmail.com',
                'password' => '$2y$10$Znxu7mh6qs80Ik9dW3M0ueaUZw1brhpX//hbpFRYqQnImjzDa29Nm',
                'remember_token' => NULL,
                'avatar' => 'avatars/8fcea216-a55d-45be-9937-a7684295f130.jpg',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-15 00:37:18',
                'updated_at' => '2025-06-15 00:37:18',
            ),
            5 => 
            array (
                'id' => 17,
                'social_id' => '116422800114849349098',
                'name' => 'Abdullah Al Mamun',
                'email' => 'aalmamun.gp@gmail.com',
                'password' => '',
                'remember_token' => NULL,
                'avatar' => 'avatars/48e636ae-f410-4e97-92a3-792e07fcb4eb.jpg',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-17 00:26:27',
                'updated_at' => '2025-06-17 00:26:27',
            ),
            6 => 
            array (
                'id' => 18,
                'social_id' => NULL,
                'name' => 'Jamshed',
                'email' => 'info@bdtask.com',
                'password' => '$2y$10$2zhHDq4/82J98M5.nxtR6.okS4GUlRI0iHQxDpk1BS4X3uOug8PnO',
                'remember_token' => NULL,
                'avatar' => 'profiles/1750170756_profile.jpg',
                'bg_image' => 'banners/1750170755_banner.jpg',
                'status' => 1,
                'created_at' => '2025-06-18 02:17:08',
                'updated_at' => '2025-06-18 02:32:36',
            ),
            7 => 
            array (
                'id' => 19,
                'social_id' => NULL,
                'name' => 'jamshed',
                'email' => 'jamshed@gmail.com',
                'password' => '$2y$10$S0sbl3VHu/DGXgL8fKNdX.6tT9MNyG2Jw88//uESFugTGzYVDHYh6',
                'remember_token' => NULL,
                'avatar' => NULL,
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-20 01:35:16',
                'updated_at' => '2025-06-20 01:35:16',
            ),
            8 => 
            array (
                'id' => 20,
                'social_id' => NULL,
                'name' => 'Temp User',
                'email' => 'hojon56153@finfave.com',
                'password' => '$2y$10$7cmjvet7e//tRMtFp.3wp.yzvU1hfvW8QnI8J2FfLlUESCmbt37Au',
                'remember_token' => 'ZcjVQ1OlmABPHntZTXCRZXUxR8nCwveodlwg85zHnxDNTX1nRte8OTwwEbuR',
                'avatar' => NULL,
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-20 01:49:05',
                'updated_at' => '2025-06-20 01:50:18',
            ),
            9 => 
            array (
                'id' => 21,
                'social_id' => NULL,
                'name' => 'jamshed',
                'email' => 'jamshed232@bdtask.com',
                'password' => '$2y$10$y8NFVA7Ajeqc6wJODms71eYQZN9PgHH.gN0c3y/HVe/XVWi5f6rEa',
                'remember_token' => NULL,
                'avatar' => NULL,
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-06-23 02:01:59',
                'updated_at' => '2025-06-23 02:02:58',
            ),
            10 => 
            array (
                'id' => 22,
                'social_id' => '114314303262805080150',
                'name' => 'Mdariful Islam',
                'email' => 'mdarifkhanbd24@gmail.com',
                'password' => '',
                'remember_token' => NULL,
                'avatar' => 'avatars/bf098d76-3234-49dc-90ac-c4fa080efe97.jpg',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-07-21 07:13:08',
                'updated_at' => '2025-07-21 07:13:08',
            ),
            11 => 
            array (
                'id' => 23,
                'social_id' => NULL,
                'name' => 'boxin',
                'email' => '01box.in@gmail.com',
                'password' => '$2y$10$r7w0BGPqyJUoTBi/2FW.YOpESmgXWMp.87bbId.vY8Ob9I1mWEHH2',
                'remember_token' => NULL,
                'avatar' => NULL,
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-07-23 10:05:56',
                'updated_at' => '2025-07-23 10:05:56',
            ),
            12 => 
            array (
                'id' => 24,
                'social_id' => '114145927139531007027',
                'name' => 'Griffin James',
                'email' => 'griffinjam149@gmail.com',
                'password' => '',
                'remember_token' => NULL,
                'avatar' => 'avatars/3fa0446b-8053-43cd-b90d-eb92979d33c7.png',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-07-25 06:28:09',
                'updated_at' => '2025-07-25 06:28:09',
            ),
            13 => 
            array (
                'id' => 25,
                'social_id' => '103966410031645647719',
                'name' => 'Ivan Namme',
                'email' => 'makonamme4050@gmail.com',
                'password' => '',
                'remember_token' => NULL,
                'avatar' => 'avatars/899eb156-cef3-45e9-8d29-cb003e18b6e1.png',
                'bg_image' => NULL,
                'status' => 1,
                'created_at' => '2025-07-26 21:48:40',
                'updated_at' => '2025-07-26 21:48:40',
            ),
        ));
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}