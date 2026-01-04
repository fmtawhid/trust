<?php

use App\Models\WebUser;
use App\Models\NewsComment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NewsComment::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(WebUser::class)->constrained()->cascadeOnDelete();
            $table->text('reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_comment_replies');
    }
};
