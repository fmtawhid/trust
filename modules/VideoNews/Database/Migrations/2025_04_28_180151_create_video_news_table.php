<?php

use App\Enums\ActivationStatusEnum;
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
        Schema::create('video_news', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('reporter_id');
            $table->foreign('reporter_id')->references('id')->on('reporters')->onDelete('cascade');

            $table->date('publish_date');
            $table->unsignedInteger('total_view')->default(0);
            $table->string('title');
            $table->longText('details');
            $table->string('thumbnail_image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->string('video')->nullable();
            $table->string('video_url')->nullable();
            $table->string('reference')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();
            $table->enum('status', ActivationStatusEnum::toArray())->default(ActivationStatusEnum::ACTIVE->value);

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
        Schema::dropIfExists('video_news');
    }
};
