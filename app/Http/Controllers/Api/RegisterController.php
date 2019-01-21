<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Hash;

class RegisterController extends ResourceController
{
   
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {

    }

    public function register(Request $request)
    {
        $this->mainModel = 'App\\Models\\User';

        $password = Hash::make($request->input('password'));
        $request->replace(array_merge($request->except(['_token', 'password_confirmation']),
        [
            'password' => $password
        ]));

        $model = parent::store($request);

        return $model;
    }

}
