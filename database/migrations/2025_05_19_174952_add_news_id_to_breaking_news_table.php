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
        Schema::table('breaking_news', function (Blueprint $table) {
            $table->foreignId('news_id')->nullable()->after('language_id')->constrained('news_msts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('breaking_news', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
            $table->dropColumn('news_id');
        });
    }
};
