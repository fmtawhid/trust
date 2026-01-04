<?php

namespace Modules\Theme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FontFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'font_style',
        'font_path',
    ];

    protected $casts = [
        'name' => 'string',
        'font_style' => 'string',
        'font_path' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
}
