<?php

use App\Models\NewsMst;
use App\Models\WebUser;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Modules\VideoNews\Entities\VideoNews;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(NewsMst::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(VideoNews::class)->nullable()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(WebUser::class)->constrained()->cascadeOnDelete();
            $table->text('comment');
            $table->boolean('is_approved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_comments');
    }
};
