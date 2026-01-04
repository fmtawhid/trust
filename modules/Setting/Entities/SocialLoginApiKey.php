<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SocialLoginApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider',
        'client_id',
        'client_secret',
        'status',
    ];
    
    protected $casts = [
        'provider' => 'string',
        'client_id' => 'string',
        'client_secret' => 'string',
        'status' => 'boolean',
    ];
}
