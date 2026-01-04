<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PhotoPost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'stitle',
        'title',
        'details',
        'reporter',
        'category_id',
        'post_by',
        'update_by',
        'meta_keyword',
        'meta_description',
        'status',
        'timestamp',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'language_id'      => 'integer',
        'stitle'           => 'string',
        'title'            => 'string',
        'details'          => 'string',
        'reporter'         => 'string',
        'category_id'      => 'integer',
        'post_by'          => 'integer',
        'update_by'        => 'integer',
        'meta_keyword'     => 'string',
        'meta_description' => 'string',
        'status'           => 'integer',
        'timestamp'        => 'integer',
    ];

    /**
     * Post Category
     *
     * @return BelongsTo
     */
    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Post User
     *
     * @return BelongsTo
     */
    public function postByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'post_by', 'id');
    }

    /**
     * Photo Post Details
     *
     * @return HasMany
     */
    public function photoPostDetails(): HasMany
    {
        return $this->hasMany(PhotoPostDetail::class, 'post_id', 'id');
    }

    /**
     * Summary of language
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
