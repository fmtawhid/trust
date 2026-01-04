<?php

namespace Modules\Archive\Entities;

use App\Models\User;
use App\Models\NewsComment;
use Illuminate\Support\Str;
use App\Models\PhotoLibrary;
use App\Models\PostSeoOnpage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Modules\Reporter\Entities\Reporter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsArchive extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'news_id',
        'language_id',
        'category_id',
        'sub_category_id',
        'encode_title',
        'seo_title',
        'stitle',
        'title',
        'news',
        'image',
        'image_base_url',
        'videos',
        'podcust_id',
        'image_alt',
        'image_title',
        'reporter',
        'reporter_message',
        'page',
        'reference',
        'ref_date',
        'post_by',
        'reporter_id',
        'update_by',
        'time_stamp',
        'post_date',
        'publish_date',
        'last_update',
        'is_latest',
        'is_featured',
        'is_recommanded',
        'reader_hit',
        'status',
    ];

    /**
     * Summary of casts
     * @var array
     */
    protected $casts = [
        'uuid'              => 'string',
        'news_id'           => 'integer',
        'language_id'       => 'integer',
        'category_id'       => 'integer',
        'sub_category_id'   => 'integer',
        'encode_title'      => 'string',
        'seo_title'         => 'string',
        'stitle'            => 'string',
        'title'             => 'string',
        'news'              => 'string',
        'image'             => 'string',
        'image_base_url'    => 'string',
        'videos'            => 'string',
        'podcust_id'        => 'integer',
        'image_alt'         => 'string',
        'image_title'       => 'string',
        'reporter'          => 'string',
        'reporter_message'  => 'string',
        'page'              => 'string',
        'reference'         => 'string',
        'ref_date'          => 'date',
        'post_by'           => 'string',
        'reporter_id'       => 'integer',
        'update_by'         => 'string',
        'time_stamp'        => 'integer',
        'post_date'         => 'date',
        'publish_date'      => 'date',
        'last_update'       => 'datetime',
        'is_latest'         => 'integer',
        'is_featured'       => 'integer',
        'is_recommanded'    => 'integer',
        'reader_hit'        => 'integer',
        'status'            => 'integer',
    ];
    

    protected static function boot()
    {
        parent::boot();
        if(Auth::check()){
            self::creating(function($model) {
                $model->uuid = (string) Str::uuid();
                $model->created_by = Auth::id();
            });

            self::updating(function($model) {
                $model->updated_by = Auth::id();
            });

            self::deleted(function($model){
                $model->updated_by = Auth::id();
                $model->save();
            });
        }

        static::addGlobalScope('sortByLatest', function (Builder $builder) {
            $builder->orderByDesc('id');
        });

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
     * Photo Library
     *
     * @return BelongsTo
     */
    public function photoLibrary(): BelongsTo
    {
        return $this->belongsTo(PhotoLibrary::class, 'image', 'actual_image_name');
    }

    /**
     * Category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Sub Category
     *
     * @return BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    /**
     * Post Reporter
     *
     * @return BelongsTo
     */
    public function reporterBy(): BelongsTo
    {
        return $this->belongsTo(Reporter::class, 'reporter_id', 'id');
    }

    /**
     * Post Seo On Page
     *
     * @return hasOne
     */
    public function postSeoOnpage(): HasOne
    {
        return $this->hasOne(PostSeoOnpage::class, 'news_id', 'news_id');
    }

    /**
     * Get all comments for the news.
     * 
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(NewsComment::class, 'news_mst_id', 'id');
    }

    /**
     * Summary of seoOnpage
     * @return HasOne
     */
    public function seoOnpage()
    {
        return $this->hasOne(PostSeoOnpage::class, 'news_id', 'id');
    }
}
