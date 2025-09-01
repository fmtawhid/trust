<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        $this->call([
            DemoDataLanguagesTableSeeder::class,
            DemoDataUsersTableSeeder::class,
            DemoDataWebUsersTableSeeder::class,
            DemoDataReportersTableSeeder::class,
            DemoDataCategoriesTableSeeder::class,
            DemoDataCategoryTopicsTableSeeder::class,
            DemoDataNewsMstsTableSeeder::class,
            DemoDataPhotoLibrariesTableSeeder::class,
            DemoDataHomePagePositionsTableSeeder::class,
            DemoDataNewsPositionMapsTableSeeder::class,
            DemoDataBreakingNewsTableSeeder::class,
            DemoDataPostSeoOnpagesTableSeeder::class,
            DemoDataPostTagsTableSeeder::class,
            DemoDataSchemaPostsTableSeeder::class,
            DemoDataVideoNewsTableSeeder::class,
            DemoDataOpinionsTableSeeder::class,
            DemoDataNewsCommentsTableSeeder::class,
            DemoDataNewsCommentRepliesTableSeeder::class,
            DemoDataAdSTableSeeder::class,
            DemoDataMenuContentsTableSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
