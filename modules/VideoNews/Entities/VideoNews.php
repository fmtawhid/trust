<?php

namespace Modules\VideoNews\Entities;

use App\Models\User;
use App\Enums\ActivationStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Modules\Reporter\Entities\Reporter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoNews extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "language_id",
        "reporter_id",
        "publish_date",
        "total_view",
        "encode_title",
        "title",
        "details",
        "thumbnail_image",
        "image_alt",
        "image_title",
        "video",
        "video_url",
        "reference",
        "meta_keyword",
        "meta_description",
        "status"
    ];

    protected $casts = [
        'language_id' => 'integer',
        'reporter_id' => 'integer',
        'publish_date' => 'date',
        'total_view' => 'integer',
        'encode_title' => 'string',
        'title' => 'string',
        'details' => 'string',
        'thumbnail_image' => 'string',
        'image_alt' => 'string',
        'image_title' => 'string',
        'video' => 'string',
        'video_url' => 'string',
        'reference' => 'string',
        'meta_keyword' => 'string',
        'meta_description' => 'string',
        'status' => ActivationStatusEnum::class,
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        if (Auth::check()) {
            self::creating(function ($model) {
                $model->created_by = Auth::id();
            });

            self::updating(function ($model) {
                $model->updated_by = Auth::id();
            });

            self::deleted(function($model){
                $model->updated_by = Auth::id();
                $model->save();
            });
        }
    }

    /**
     * Summary of reporter
     * @return BelongsTo
     */
    public function reporter()
    {
        return $this->belongsTo(Reporter::class, 'reporter_id');
    }

    /**
     * Summary of language
     * @return BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
    
    /**
     * Post User
     *
     * @return BelongsTo
     */
    public function postByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
}
