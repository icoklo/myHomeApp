<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInformationConfig;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookmarks = auth()->user()->bookmarks()
            ->orderBy('sort_order', 'ASC')
            ->limit(4)
            ->get();

        $city = '';
        $subscriptions = auth()->user()->informations;
        $userInformationConfig = UserInformationConfig::where('user_id', '=', auth()->user()->id)
            ->where('name', '=', 'city')->first();
        if(!is_null($userInformationConfig))
        {
            $city = $userInformationConfig->value;
        }

        $message = '';
        foreach(auth()->user()->getAttributes() as $key => $value)
        {
            if($key !== 'email_verified_at' AND $key !== 'remember_token' AND is_null($value))
            {
                $message = __('translations.user_profile_notification');
            }
        }

        return view('home')
            ->with('bookmarks', $bookmarks)
            ->with('subscriptions', $subscriptions)
            ->with('city', $city)
            ->with('message', $message);
    }
}
