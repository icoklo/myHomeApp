<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordReset;

class User extends Authenticatable
{
    use Notifiable;

    /**
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = ['id'];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * Get the comments for the blog post.
    */
    public function bookmarks()
    {
        return $this->hasMany('App\Models\Bookmark', 'user_id', 'id');
    }

    /**
    * Send the password reset notification.
    *
    * @param  string  $token
    * @return void
    */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    public function informations()
	{
		return $this->belongsToMany(\App\Models\Information::class, 'user_information', 'user_id', 'information_id');
	}

    public function user_information_config()
	{
		return $this->belongsToMany(\App\Models\UserInformationConfig::class, 'user_information_config', 'user_id', 'information_id');
	}
}
