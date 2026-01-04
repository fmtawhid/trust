<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news_msts', function (Blueprint $table) {
            $table->boolean('is_auto_post')->default(true)->after('reader_hit');
            $table->boolean('is_posted_to_social')->default(false)->after('is_auto_post');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_msts', function (Blueprint $table) {
            $table->dropColumn('is_auto_post');
            $table->dropColumn('is_posted_to_social');
        });
    }
};
