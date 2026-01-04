<?php

namespace Modules\Opinion\Entities;

use App\Enums\ActivationStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opinion extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'language_id',
        'name',
        'designation',
        'encode_title',
        'title',
        'content',
        'person_image',
        'news_image',
        'image_alt',
        'image_title',
        'status',
        'meta_keyword',
        'meta_description',
    ];

    protected $casts = [
        'language_id' => 'integer',
        'name' => 'string',
        'designation' => 'string',
        'encode_title' => 'string',
        'title' => 'string',
        'content' => 'string',
        'person_image' => 'string',
        'news_image' => 'string',
        'image_alt' => 'string',
        'image_title' => 'string',
        'status' => ActivationStatusEnum::class,
        'meta_keyword'=> 'string',
        'meta_description'=> 'string',
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

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

}
