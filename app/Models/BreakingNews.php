<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BreakingNews extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'news_id',
        'title',
        'time_stamp',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'language_id'=> 'integer',
        'news_id'    => 'integer',
        'title'      => 'string',
        'time_stamp' => 'integer',
        'status'     => 'integer',
    ];

    /**
     * Summary of language
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
    
}
