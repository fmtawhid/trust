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
        Schema::create('auto_post_settings', function (Blueprint $table) {
            $table->id();

            // Platform: facebook, twitter, etc.
            $table->string('platform'); // 'facebook' or 'twitter'

            // Facebook
            $table->string('page_id')->nullable();

            // Twitter (X)
            $table->string('api_key')->nullable();
            $table->string('api_secret')->nullable();
            $table->string('access_token_secret')->nullable();

            // Common
            $table->text('access_token')->nullable();
            $table->boolean('is_test_mode')->default(false); // it define which version use is sendbox, paid, free etc.
            $table->boolean('is_active')->default(false);

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
        Schema::dropIfExists('auto_post_settings');
    }
};
