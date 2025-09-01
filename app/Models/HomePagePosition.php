<?php

namespace App\Models;

use Ramsey\Uuid\Type\Integer;
use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomePagePosition extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'position_no',
        'cat_name',
        'slug',
        'max_news',
        'category_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'language_id' => 'integer',
        'position_no' => 'integer',
        'cat_name'    => 'string',
        'slug'        => 'string',
        'max_news'    => 'string',
        'category_id' => 'integer',
        'status'      => 'integer',
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
