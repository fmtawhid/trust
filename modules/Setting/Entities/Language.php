<?php

namespace Modules\Setting\Entities;

use App\Models\Appsetting;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;    
    use LogsActivity;

    protected $fillable = ['title' , 'slug' , 'status'];  

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Setting (Language)')
            ->setDescriptionForEvent(fn(string $eventName) => "You have {$eventName} a language")
            ->logAll();
    }

    public static function getDefault()
    {
        return Cache::remember('defaultLanguage', 60, function () {
            $defaultLanguageId = Appsetting::first()->language_id ?? 1; // Default to 1 if not set
            return self::find($defaultLanguageId);
        });
    }

    public function category()
    {
        return $this->hasMany(Category::class, 'language_id', 'id');
    }
}
