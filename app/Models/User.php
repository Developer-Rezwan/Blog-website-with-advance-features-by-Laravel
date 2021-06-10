<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullName',
        'email',
        'phone_number',
        'photo',
        'password',
        'role',
        'email_varification_token',
        'email_varified',
        'email_verified_at',
        'login_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'login_at'          => 'datetime'
    ];

    public function routeNotificationForNexmo($notification)
    {
        return $this->phone_number;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function about()
    {
        return $this->hasOne(About::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'sender_id', 'id');
    }
}