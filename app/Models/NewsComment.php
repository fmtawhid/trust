<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Opinion\Entities\Opinion;
use Modules\VideoNews\Entities\VideoNews;

class NewsComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_mst_id',
        'video_news_id',
        'opinion_id',
        'web_user_id',
        'comment',
        'is_approved',
    ];

    protected $casts = [
        'video_news_id' => 'integer',
        'news_mst_id' => 'integer',
        'opinion_id' => 'integer',
        'web_user_id' => 'integer',
        'comment' => 'string',
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function replies(): HasMany
    {
        return $this->hasMany(NewsCommentReply::class, 'news_comment_id')->where('is_approved', 1)->with('user');
    }

    public function repliesAll(): HasMany
    {
        return $this->hasMany(NewsCommentReply::class, 'news_comment_id')->with('user');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(WebUser::class, 'web_user_id');
    }

    public function newsMst()
    {
        return $this->belongsTo(NewsMst::class, 'news_mst_id');
    }

    public function videoNews()
    {
        return $this->belongsTo(VideoNews::class, 'video_news_id');
    }

    public function opinion()
    {
        return $this->belongsTo(Opinion::class, 'opinion_id');
    }

}
