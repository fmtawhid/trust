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
        Schema::table('themes', function (Blueprint $table) {
            $table->string('font_family')->nullable()->after('text_color');
            $table->string('font_size')->nullable()->after('font_family');
            $table->string('footer_color')->nullable()->after('font_size');
            $table->string('hover_color')->nullable()->after('footer_color');
            $table->boolean('is_default')->default(1)->after('hover_color');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('themes', function (Blueprint $table) {
            $table->dropColumn(['font_family', 'font_size', 'is_default', 'footer_color', 'hover_color']);
        });
    }
};
