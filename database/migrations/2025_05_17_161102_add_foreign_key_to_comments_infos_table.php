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
        Schema::table('comments_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('news_id')->change();

            $table->foreign('news_id')
                ->references('id')
                ->on('news_msts')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments_infos', function (Blueprint $table) {
            $table->dropForeign(['news_id']);
        });
    }
};
