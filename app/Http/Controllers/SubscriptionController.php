<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
use App\Models\Information;
use App\Models\UserInformation;
use App\Models\UserInformationConfig;

class SubscriptionController extends ResourceController
{
    const DATE_ID = 1;
    const WEATHER_ID = 2;
    const CURRENCY_LIST_ID = 2;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->mainModel = '';

        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = auth()->user()->informations;

        return view('subscription.index')
            ->with('subscriptions', $subscriptions);
    }

    public function getCities()
    {
        return [
            'Varaždin',
            'Zagreb',
            'Virovitica'
        ];
    }

    public function getIntervals()
    {
        return [
            __('translations.1hour')        => 3600,
            __('translations.1min')         => 60,
            __('translations.10sec')        => 10,
            __('translations.1sec')         => 1,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $informations = Information::all();
        $cities = $this->getCities();
        $intervals = $this->getIntervals();

        return view('subscription.create')
            ->with('informations', $informations)
            ->with('cities', $cities)
            ->with('intervals', $intervals);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userInformation = new UserInformation();
        $user = auth()->user();
        $userInformation->user_id = $user->id;
        $userInformation->information_id = intval($request->input('information'));
        $userInformation->poll_interval = intval($request->input('poll_interval'));
        $userInformationConfig = new UserInformationConfig();
        $userInformationConfig->user_id = $user->id;
        $userInformationConfig->information_id = intval($request->input('information'));

        switch(intval($request->input('information')))
        {
            case self::WEATHER_ID:
                $userInformationConfig->name = 'Grad';
                $userInformationConfig->value = $request->input('city');
                $userInformationConfig->save();
                break;
            case self::CURRENCY_LIST_ID:
                break;
        }
        $userInformation->save();

        return redirect(route('subscriptions.index'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
