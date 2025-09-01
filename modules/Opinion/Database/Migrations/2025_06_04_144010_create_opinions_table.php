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
        Schema::create('opinions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');

            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('encode_title', 200);
            $table->text('title');
            $table->longText('content');
            $table->string('person_image')->nullable();
            $table->string('news_image')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_title')->nullable();
            $table->enum('status', ActivationStatusEnum::toArray())->default(ActivationStatusEnum::ACTIVE->value);
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();

            // Either this:
            $table->updateCreatedBy();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinions');
    }
};
