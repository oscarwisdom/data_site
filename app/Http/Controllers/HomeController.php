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
     * @return \Illuminate\Contracts\Support\Renderable

     */
    public function index()
    {
        return view('front.home');
    }

    public function services()
    {
        return view('front.services');
    }

    public function transactions()
    {
        return view('front.transactions');
    }

    public function help()
    {
        return view('front.help');
    }

    public function settings()
    {
        return view('front.settings');
    }

    public function about()
    {
        return view('front.about');
    }

    public function how_it_works()
    {
        return view('front.how_it_work');
    }
}
