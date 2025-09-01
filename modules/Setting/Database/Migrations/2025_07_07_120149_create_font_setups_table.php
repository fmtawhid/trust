<?php

use App\Enums\FontSetupEnum;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Entities\Language;
use Illuminate\Database\Schema\Blueprint;
use Modules\Setting\Entities\FontSetting;
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
        Schema::create('font_setups', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Language::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(FontSetting::class)->constrained()->cascadeOnDelete();
            $table->enum('type', FontSetupEnum::toArray())->default(FontSetupEnum::PRINCIPAL->value)
                ->comment('1: Principal, 2: Alternate, 3: Supplementary');
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
        Schema::dropIfExists('font_setups');
    }
};
