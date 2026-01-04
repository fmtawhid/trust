<?php

namespace Modules\Setting\Entities;

use App\Enums\FontSetupEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FontSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'font_setting_id',
        'type',
    ];

    protected $casts = [
        'language_id' => 'integer',
        'font_setting_id' => 'integer',
        'type' => FontSetupEnum::class,
    ];

    /**
     * Get font setup by language ID and group by type.
     * @param mixed $languageId
     * @return array[]
     */
    public static function getByLanguageGroupedByType($languageId)
    {
        $result = self::where('language_id', $languageId)->get();

        $grouped = [];
        foreach ($result as $row) {
            $grouped[$row->type->value] = $row;
        }

        return $grouped;
    }
}
