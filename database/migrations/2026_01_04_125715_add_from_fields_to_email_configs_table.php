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
        Schema::table('email_configs', function (Blueprint $table) {
            $table->string('from_address')->nullable()->after('mailtype');
            $table->string('from_name')->nullable()->after('from_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_configs', function (Blueprint $table) {
            $table->dropColumn(['from_address', 'from_name']);
        });
    }
};
