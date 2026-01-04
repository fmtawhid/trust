<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordForWebUserNotification;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class WebUser extends Authenticatable implements AuthenticatableContract
{
    use HasFactory, Notifiable;
    protected $table = 'web_users';

    protected $fillable = [
        "social_id",
        "name",
        "email",
        "password",
        "remember_token",
        "status",
        "avatar",
        "bg_image"
    ];

    protected $casts = [
        "social_id" => "string",
        "name" => "string",
        "email" => "string",
        "password" => "string",
        "status" => "boolean",
        "avatar" => "string",
        "bg_image" => "string"
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordForWebUserNotification($token));
    }
}
