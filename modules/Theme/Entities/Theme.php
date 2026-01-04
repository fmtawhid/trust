<?php

namespace Modules\Theme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'image_path', 
        'background_color',
        'text_color',
        'font_family',
        'font_size',
        'footer_color',
        'hover_color',
        'is_default',
        'is_active',
        'updated_by',
    ];

    protected $casts = [
        'name' => 'string',
        'image_path' => 'string',
        'background_color' => 'string',
        'text_color' => 'string',
        'font_family' => 'string',
        'font_size' => 'string',
        'footer_color' => 'string',
        'hover_color' => 'string',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
        'updated_by' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
