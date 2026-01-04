<?php

use Illuminate\Support\Facades\Schema;
use Modules\Archive\Entities\NewsArchive;
use Modules\Setting\Entities\Language;
use Modules\Category\Entities\Category;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_archives', function (Blueprint $table) {
            NewsArchive::truncate();
            $table->foreignIdFor(Language::class)->after('news_id')->constrained();
            $table->foreignIdFor(Category::class)->after('language_id')->constrained();
            $table->foreignId('sub_category_id')->after('category_id')->nullable()->constrained('categories');
            $table->text('reporter_message')->after('reporter')->nullable();
            $table->boolean('is_featured')->after('is_latest')->default(0);
            $table->boolean('is_recommanded')->after('is_featured')->default(0);
            $table->bigInteger('reporter_id')->after('post_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_archives', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
            $table->dropColumn('language_id');
            
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('sub_category_id');
            
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            $table->dropColumn('reporter_message');
            $table->dropColumn('is_featured');
            $table->dropColumn('is_recommanded');
            $table->dropColumn('reporter_id');
        });
    }
};
