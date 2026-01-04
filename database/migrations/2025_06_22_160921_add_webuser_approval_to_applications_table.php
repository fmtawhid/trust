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
        Schema::table('applications', function (Blueprint $table) {
            $table->tinyInteger('web_user_can_login')->default(0)->after('show_reporter_message');
            $table->tinyInteger('web_user_can_comment')->default(0)->after('web_user_can_login');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('web_user_can_login');
            $table->dropColumn('web_user_can_comment');
        });
    }
};
