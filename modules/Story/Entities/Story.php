<?php

namespace Modules\Story\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Story extends Model
{
    use HasFactory;

    protected $fillable = ["language_id", "title", "slug", "views", "created_by", "updated_by"];

    public function getCreatedAtAttribute($value): string
    {

        if ($value === null) {
            return 'N/A';
        } else {
            return Carbon::parse($value)->format('Y-m-d H:i:s');
        }

    }

    public function details(): HasMany
    {
        return $this->hasMany(StoryDetail::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function latestDetail(): HasOne
    {
        return $this->hasOne(StoryDetail::class, 'story_id')->oldestOfMany();
    }

    public function storyDetails(): HasMany
    {
        return $this->hasMany(StoryDetail::class);
    }
}
