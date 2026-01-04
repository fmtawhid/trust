<?php

namespace Modules\Poll\Entities;

use App\Enums\ActivationStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Modules\Localize\Entities\Language;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poll extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'language_id',
        'question',
        'vote_permission',
        'status',
        'meta_keyword',
        'meta_description',
    ];

    protected $casts = [
        'language_id'=> 'integer',
        'question' => 'string',
        'vote_permission' => 'integer',
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

    public function options()
    {
        return $this->hasMany(PollOption::class, 'poll_id');
    }

    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }

    public function getTotalVotesAttribute()
    {
        return $this->options->sum('total_vote');
    }
    
}
