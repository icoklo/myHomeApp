<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
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

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = auth()->user()->bookmarks;

        return view('bookmark.index')
            ->with('bookmarks', $bookmarks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookmark.create');
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
        $model->user_id = auth()->user()->id;
        $model->save();
        $this->saveMedia($request, $model, 'bookmark_icon.');

        return redirect(route('bookmarks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookmark = Bookmark::find($id);

        return view('bookmark.edit')
            ->with('bookmark', $bookmark);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = parent::update($request, $id);
        $this->saveMedia($request, $model, 'bookmark_icon.');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(parent::destroy($id) == true)
        {
            return redirect()->back();
        }
        else
        {
            return "Greska";
        }
    }
}
