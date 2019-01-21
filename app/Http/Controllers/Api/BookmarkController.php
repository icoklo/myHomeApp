<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ResourceController;
use Illuminate\Support\Facades\Hash;
use App\Models\Bookmark;

class BookmarkController extends ResourceController
{
   
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->mainModel = 'App\\Models\\Bookmark'; 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->replace($request->except('_token'));
        $model = parent::store($request);
        $model->user_id = 1;
        $model->save();

        return $model;
    }

}