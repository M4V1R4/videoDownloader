<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Url;
Use App;
use App\Http\Controllers\Auth;

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
        $id = auth()->user()->id;
        $urls =Url::All();
        $urls = Url::where('user_id', $id)->get();
        return view('home', compact('urls'));
    }

}
