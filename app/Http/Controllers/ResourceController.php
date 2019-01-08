<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    protected $mainModel;
    protected $modelRequest;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $modelRequest = new $this->modelRequest;
        // $request->validate(
        //     $modelRequest->rules()
        // );

        $input = $request->all();
        $model = $this->mainModel::firstOrCreate($input);
        return $model;
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
        //
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
        $model = $this->mainModel::findOrFail($id);
        $model->update($request->all());
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = $this->mainModel::findOrFail($id);

        if( $model->delete() ) {
            return true;
        }
        else {
            return false;
        }
    }

    public function saveMedia(Request $request, $model, $filename)
    {
        if ($request->hasFile('icon') AND $request->file('icon')->isValid())
        {
            $folder = 'icons/'.$model->id;
            $path = Storage::disk('public')
                ->putFileAs($folder, $request->file('icon'), $filename.$request->icon->extension());
            $model->icon = $path;
            $model->save();
        }
    }

    public function secondsToHumanReadable(int $seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;
        return $hours > 0 ? "$hours hours" :
            ($minutes > 0 ? "$minutes minutes" :
            "$seconds seconds remaining");
    }
}
