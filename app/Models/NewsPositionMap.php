<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsPositionMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_id', 'home_position', 'category_id', 'category_position', 'sub_category_id', 'sub_category_position', 'status'
    ];

    /**
     * Get the associated news.
     *
     * @return BelongsTo
     */
    public function news(): BelongsTo
    {
        return $this->belongsTo(NewsMst::class, 'news_id', 'id');
    }

    /**
     * Get the associated category.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Get the associated subcategory.
     *
     * @return BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }
}
