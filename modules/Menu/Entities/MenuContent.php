<?php

namespace Modules\Menu\Entities;

use App\Models\NewsMst;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Session;

class MenuContent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        'content_type',
        'content_id',
        'menu_position',
        'menu_level',
        'link_url',
        'slug',
        'parent_id',
        'menu_id',
        'status',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'language_id'   => 'integer',
        'content_type'  => 'string',
        'content_id'    => 'integer',
        'menu_position' => 'integer',
        'menu_level'    => 'string',
        'link_url'      => 'string',
        'slug'          => 'string',
        'parent_id'     => 'integer',
        'menu_id'       => 'integer',
        'status'        => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!isset($model->language_id)) {
                $model->language_id = Session::get('language_id', 1);
            }
        });
    }

    /**
     * Summary of menu
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function submenus(): HasMany
    {
        return $this->hasMany(MenuContent::class, 'parent_id')
                    ->where('status', 1)
                    ->where('content_type','categories')
                    ->orderBy('menu_position', 'asc');
    }

    public function pagesubmenus(): HasMany
    {
        return $this->hasMany(MenuContent::class, 'parent_id')
                    ->where('status', 1)
                    ->where('content_type','!=','categories')
                    ->orderBy('menu_position', 'asc');
    }

    public function news(): BelongsTo
    {
        return $this->belongsTo(NewsMst::class, 'content_id');
    }

    // Load top 4 news for main menu
    public function topNewsFromMain(): HasOne
    {
        return $this->hasOne(NewsMst::class, 'id', 'content_id')
                    ->orderBy('created_at', 'desc');
    }

    // Load top 3 news from submenus
    public function topNewsFromSubmenus(): HasManyThrough
    {
        return $this->hasManyThrough(
            NewsMst::class,
            MenuContent::class,
            'parent_id', // foreign key on menu_contents (submenus)
            'id',        // foreign key on news_msts
            'id',        // local key on main menu
            'content_id' // local key on submenus to match news_msts.id
        )->orderBy('created_at', 'desc')->limit(3);
    }

}
