<?php

namespace Modules\Story\Entities;

use Modules\Story\Entities\Story;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoryDetail extends Model
{
    protected $fillable = ["story_id", "title", "image_path", "button_text", "button_link", "views", "clicks"];

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class);
    }
}
