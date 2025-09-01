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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();

            $table->string('question');
            $table->tinyInteger('vote_permission')->default(0)->comment('0 for all, 1 for registered users');
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
        Schema::dropIfExists('polls');
    }
};
