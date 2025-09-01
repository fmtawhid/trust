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
        Schema::create('news_position_maps', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('news_id')->constrained('news_msts')->onDelete('cascade');
            $table->integer('home_position')->nullable()->comment('Position on the homepage');

            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->integer('category_position')->nullable()->comment('Position within a category');

            $table->foreignId('sub_category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->integer('sub_category_position')->nullable()->comment('Position within a sub category');
            
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_position_maps');
    }
};
