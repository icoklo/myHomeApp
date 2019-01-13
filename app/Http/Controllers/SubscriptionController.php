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
    const CURRENCY_LIST_ID = 3;

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

        return $this->curlFunction($url);
    }

    public function curlFunction($url)
    {
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

        return $this->curlFunction($url);
    }

    public function getDate(Request $request)
    {
        $json = json_encode([
            'date' => date('d.m.Y')
        ]);

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

        $start = $this->getOrdinalNumberStart();
        foreach($subscriptions as $sub)
        {
            $sub->ordinalNumber = $start;
            $sub->poll_interval_human = $this->getPollIntervalHuman($sub->pivot->poll_interval_2);
            $start++;
        }

        return view('subscription.index')
            ->with('subscriptions', $subscriptions);
    }

    public function getCities()
    {
        return [
            '',
            'Varaždin',
            'Zagreb',
            'Virovitica',
            'Dubrovnik',
            'Rijeka',
            'Split',
            'Osijek',
            'Pitomača'
        ];
    }

    public function getCurrencies()
    {
        return [
            '',
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
            '',
            'RBA',
            'Erste',
            'Zagrebacka'
        ];
    }

    public function getCategories()
    {
        return [
            '',
            'srednji',
            'kupovni',
            'prodajni'
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
            ->with('userInformationConfig', [])
            ->with('informations', $informations)
            ->with('cities', $cities)
            ->with('intervals', $intervals)
            ->with('currency', $currency)
            ->with('banks', $banks)
            ->with('categories', $categories);
    }

    public function storeUpdate(Request $request)
    {
        $user = auth()->user();
        $userInformation = UserInformation::firstOrCreate([
            'user_id'           => $user->id,
            'information_id'    => intval($request->input('information')),
        ]);
        UserInformation::where('user_id', '=', $user->id)
        ->where('information_id', '=', intval($request->input('information')))
        ->update([
            'poll_interval_2' => intval($request->input('poll_interval'))
        ]);

        // remove empty array elements
        $configuration = array_filter($request->input('configuration'));

        foreach($configuration as $key => $value)
        {
            $userInformationConfig = UserInformationConfig::firstOrCreate(
                [
                    'user_id'           => $user->id,
                    'information_id'    => intval($request->input('information')),
                    'name'              => $key,
                ]
            );

            UserInformationConfig::where('user_id', '=', $user->id)
            ->where('information_id', '=', intval($request->input('information')))
            ->where('name', '=', $key)
            ->update([
                'value'             => $value
            ]);
        }

        return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->storeUpdate($request))
        {
            return redirect(route('subscriptions.index'))->with('message', __('translations.store_update'));
        }

        return redirect(route('subscriptions.index'))->with('message', __('translations.error'));;
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
        $userInformation = UserInformation::where('user_id', '=', auth()->user()->id)
            ->where('information_id', '=', $id)
            ->first();
        $userInformationConfig = UserInformationConfig::where('user_id', '=', auth()->user()->id)
            ->where('information_id', '=', $id)
            ->get(['name', 'value']);

        if(!$userInformationConfig->isEmpty())
        {
            $userInformationConfig = $userInformationConfig->mapWithKeys( function ($item) {
                return [$item['name'] => $item['value']];
            })->toArray();
        }
        else {
            $userInformationConfig = [];
        }

        return view('subscription.edit')
            ->with('informations', Information::all())
            ->with('userInformation', $userInformation)
            ->with('userInformationConfig', $userInformationConfig)
            ->with('cities', $this->getCities())
            ->with('intervals', $this->getIntervals())
            ->with('currency', $this->getCurrencies())
            ->with('banks', $this->getBanks())
            ->with('categories', $this->getCategories());
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
        if($this->storeUpdate($request))
        {
            return redirect(route('subscriptions.index'))->with('message', __('translations.store_update'));
        }

        return redirect(route('subscriptions.index'))->with('message', __('translations.error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        $userInformationConfig = UserInformationConfig::where('user_id', '=', $user->id)
            ->where('information_id', '=', $id)
            ->get();

        if(!$userInformationConfig->isEmpty())
        {
            $userInformationConfig = UserInformationConfig::where('user_id', '=', $user->id)
                ->where('information_id', '=', $id)
                ->delete();
        }
        else {
            $userInformationConfig = true;
        }

        $userInformation = UserInformation::where('user_id', '=', $user->id)
            ->where('information_id', '=', $id)
            ->delete();

        if($userInformation AND $userInformationConfig)
        {
            return redirect()->back()->with('message', __('translations.destroy'));
        }
        else
        {
            return redirect()->back()->with('message', __('translations.error'));
        }
    }
}
