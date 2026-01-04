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
        Schema::table('categories', function (Blueprint $table) {
            $table->unsignedBigInteger('language_id')->after('parents_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            $table->string('meta_keyword')->after('updated_by')->nullable();
            $table->string('meta_description')->after('meta_keyword')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['language_id']);
            $table->dropColumn(['language_id', 'meta_keyword', 'meta_description']);
        });
    }
};
