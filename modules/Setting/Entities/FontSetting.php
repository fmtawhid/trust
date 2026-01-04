<?php

namespace Modules\Setting\Entities;

use Carbon\Carbon;
use App\Enums\FontSourceEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FontSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        "source_url",
        "name",
        "font_family",
        "source",
        "created_by",
        "updated_by",
    ];

    protected $cast = [
        "source_url" => "string",
        "name" => "string",
        "font_family" => "string",
        "source" => FontSourceEnum::class,
        "created_by" => "string",
        "updated_by" => "string",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function getCreatedAtAttribute($value): string
    {
        if ($value === null) {
            return 'N/A';
        } else {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        }

    }

    public function getUpdatedAtAttribute($value): string
    {
        if ($value === null) {
            return 'N/A';
        } else {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        }

    }
}
