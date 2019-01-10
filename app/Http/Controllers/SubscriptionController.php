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

    public function getWeather(Request $request)
    {
        $city = $request->input('q');
        $url = "https://api.openweathermap.org/data/2.5/weather";
        $url .= '?q='.$city.'&lang=hr&units=metric&appid='.env('OPEN_WEATHER_MAP_API_KEY');
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
        curl_close($curl);

        return $json;
    }

    public function getCurencyList(Request $request)
    {
        // samo placeni acount moze mijenjati valutu, free ne moze!!!
        $base = $request->input('base', 'EUR');
        $url = "http://data.fixer.io/api/latest";
        $url .= '?access_key='.env('FIXER_API_KEY');
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($curl);
        curl_close($curl);

        return $json;
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

    public function getCurrencies()
    {
        return [
            'EUR',
        ];
    }

    public function getIntervals()
    {
        return [
            __('translations.30sec')        => 30,
            __('translations.1min')         => 60,
            __('translations.10min')        => 600,
            __('translations.1hour')        => 3600,
        ];
    }

    public function getBanks()
    {
        return [
            'RBA',
            'Erste',
            'Zagrebacka'
        ];
    }

    public function getCategories()
    {
        return [
            'srednji',
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
        $currency = $this->getCurrencies();
        $banks = $this->getBanks();
        $categories = $this->getCategories();

        return view('subscription.create')
            ->with('informations', $informations)
            ->with('cities', $cities)
            ->with('intervals', $intervals)
            ->with('currency', $currency)
            ->with('banks', $banks)
            ->with('categories', $categories);
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
