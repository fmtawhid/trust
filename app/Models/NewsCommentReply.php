<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsCommentReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_comment_id',
        'web_user_id',
        'reply',
        'is_approved'
    ];

    protected $casts = [
        'news_comment_id' => 'integer',
        'web_user_id' => 'integer',
        'reply' => 'string',
        'is_approved' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(WebUser::class, 'web_user_id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(NewsComment::class, 'news_comment_id');
    }

}
