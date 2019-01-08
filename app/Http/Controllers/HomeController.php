<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $subscriptions = auth()->user()->informations()->get();

        return view('home')
            ->with('bookmarks', $bookmarks)
            ->with('subscriptions', $subscriptions);
    }
}
