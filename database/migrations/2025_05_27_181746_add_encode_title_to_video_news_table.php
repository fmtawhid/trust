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
        Schema::table('video_news', function (Blueprint $table) {
            $table->string('encode_title', 200)->after('total_view');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('video_news', function (Blueprint $table) {
            $table->dropColumn('encode_title');
        });
    }
};
