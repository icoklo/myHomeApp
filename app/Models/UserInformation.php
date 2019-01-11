<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $fillable = [
		'user_id',
		'information_id',
        'sort_order',
        'poll_interval_2'
	];

    protected $table = 'user_information';

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [

    ];
}
