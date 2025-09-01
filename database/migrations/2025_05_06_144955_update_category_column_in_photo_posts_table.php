<?php

use Illuminate\Support\Facades\Schema;
use Modules\Category\Entities\Category;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('photo_posts', function (Blueprint $table) {
            if (Schema::hasColumn('photo_posts', 'category')) {
                $table->dropColumn('category');
            }

            $table->foreignIdFor(Category::class)
                ->after('reporter')
                ->nullable()
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('photo_posts', function (Blueprint $table) {
            // Drop the foreign key and the column
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // Restore the old 'category' column
            $table->string('category', 255)->nullable()->after('reporter');
        });
    }
};
