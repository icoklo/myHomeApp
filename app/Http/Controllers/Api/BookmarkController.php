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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        $bookmarks = $this->mainModel::all();

        // $start = $this->getOrdinalNumberStart();
        // foreach ($bookmarks as $bookmark) {
        //     $bookmark->ordinalNumber = $start;
        //     $start++;
        // }

        return $bookmarks;
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

    public function getBookmark($id)
    {
        $bookmark = $this->mainModel::find($id);

        return $bookmark;
    }

    public function update(Request $request, $id)
    {
        $request->replace($request->except('_token'));
        $model = parent::update($request, $id);

        return $model;
    }

    public function destroy($id)
    {
        if(parent::destroy($id))
        {
            return json_encode([
                "message" => "Uspjeh"
            ]);
        }
        else {
            return json_encode([
                "message" => "Greska"
            ]);
        }
       
    }

}