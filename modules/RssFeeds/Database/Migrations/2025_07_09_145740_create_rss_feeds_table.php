<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rss_feeds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('paper_language')->constrained('languages')->onDelete('cascade');

            $table->string('feed_name');
            $table->string('slug', 200)->nullable();
            $table->text('feed_url');
            $table->unsignedInteger('posts')->default(0);

            $table->tinyInteger('show_button')->default(1);
            $table->string('button_text')->nullable();

            $table->tinyInteger('status')->default(1);

            $table->updateCreatedBy();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rss_feeds');
    }
};
