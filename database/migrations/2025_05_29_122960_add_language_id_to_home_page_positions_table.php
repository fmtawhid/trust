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
        Schema::table('home_page_positions', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id')->after('id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->integer('position_no')->after('language_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('home_page_positions', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
            $table->dropColumn('language_id');
            $table->dropColumn('position_no');
        });
    }
};
