<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Opinion\Entities\Opinion;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->foreignIdFor(Opinion::class)->nullable()->after('video_news_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news_comments', function (Blueprint $table) {
            $table->dropForeign(['opinion_id']);
            $table->dropColumn('opinion_id');
        });
    }
};
