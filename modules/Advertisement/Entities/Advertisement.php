<?php

namespace Modules\Advertisement\Entities;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Theme\Entities\Theme;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    // Explicitly define the table name
    protected $table = 'ad_s';

    protected $fillable = [
        'id',
        'uuid',
        'language_id',
        'page',
        'ad_position',
        'ad_type',
        'embed_code',
        'large_status',
        'mobile_status',
        'theme',
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

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function themeRelation()
    {
        return $this->belongsTo(Theme::class, 'theme');
    }
}
