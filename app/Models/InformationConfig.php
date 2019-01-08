<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformationConfig extends Model
{
    protected $fillable = [
		'name',
		'information_id',
        'default_value'
	];

    protected $table = 'information_config';

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [

    ];
}
