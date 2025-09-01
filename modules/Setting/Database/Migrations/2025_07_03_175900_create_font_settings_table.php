<?php

use App\Enums\FontSourceEnum;
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
        Schema::create('font_settings', function (Blueprint $table) {
            $table->id();
            $table->mediumText('source_url')->nullable();
            $table->string('name');
            $table->string('font_family');
            $table->enum( 'source', FontSourceEnum::toArray());
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
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
        Schema::dropIfExists('font_settings');
    }
};
