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
        Schema::table('top_breakings', function (Blueprint $table) {
            if (Schema::hasColumn('top_breakings', 'category_slug')) {
                $table->dropColumn('category_slug');
            }

            $table->foreignIdFor(Category::class)
                ->after('uuid')
                ->nullable()
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('top_breakings', function (Blueprint $table) {
            // Drop the new foreign key column
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            // Restore the old 'category_slug' column
            $table->string('category_slug', 100)->nullable()->after('uuid');
        });
    }
};
