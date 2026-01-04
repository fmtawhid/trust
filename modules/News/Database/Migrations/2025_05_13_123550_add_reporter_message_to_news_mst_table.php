<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::table('news_msts', function (Blueprint $table) {

            $table->foreignIdFor(Category::class)->after('news_id')->constrained();
            $table->foreignId('sub_category_id')->after('category_id')->nullable()->constrained('categories');
            $table->text('reporter_message')->after('reporter')->nullable();
            $table->boolean('is_featured')->after('is_latest')->default(0);
            $table->boolean('is_recommanded')->after('is_featured')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_msts', function (Blueprint $table) {
            $table->dropForeign(['sub_category_id']);
            $table->dropColumn('sub_category_id');
            
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            
            $table->dropColumn('reporter_message');
            $table->dropColumn('is_featured');
            $table->dropColumn('is_recommanded');
        });
    }
};
