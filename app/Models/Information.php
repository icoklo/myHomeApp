<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = [
		'name',
		'poll_interval',
	];

    protected $table = 'information';

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [

    ];

    public function getPollIntervalAttribute($value)
    {
        $returnValue = '';

        switch($value)
        {
            case 3600:
                $returnValue = __('translations.1hour');
                break;
            case 600:
                $returnValue = __('translations.10min');
                break;
            case 60:
                $returnValue = __('translations.1min');
                break;
            case 30:
                $returnValue = __('translations.30sec');
                break;
        }

        return $returnValue;
    }
}
