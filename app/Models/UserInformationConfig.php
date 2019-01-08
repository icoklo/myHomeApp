<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformationConfig extends Model
{
    protected $fillable = [
		'user_id',
		'information_id',
        'name',
        'value'
	];

    protected $table = 'user_information_config';

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [

    ];

    public function user()
    {

    }
}
