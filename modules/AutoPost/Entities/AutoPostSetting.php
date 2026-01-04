<?php

namespace Modules\AutoPost\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AutoPostSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'platform',
        'page_id',
        'api_key',
        'api_secret',
        'access_token_secret',
        'access_token',
        'is_test_mode',
        'is_active',
    ];
}
