<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
Use App;
use App\Http\Controllers\Auth;

class UrlsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $id = auth()->user()->id;
        $urls =Url::All();
        $urls = Url::where('user_id', $id)->get();
        return view('home', compact('urls'));

        
        
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
        $nuevoUrl = new Url;
        $nuevoUrl->url = $request->url;
        $nuevoUrl->user_id = auth()->user()->id;
        $nuevoUrl->format = $request->format;
        $nuevoUrl->state = 'En proceso';
        $nuevoUrl->save();
        return back();

                        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function show(Urls $urls)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function edit(Urls $urls)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Urls $urls)
    {
        $model = Url::where('id', $id)->get()[0];
        $model->state = $request->state;
        $model->update();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Urls  $urls
     * @return \Illuminate\Http\Response
     */
    public function destroy(Urls $urls)
    {
        $urls->delete();
        return back();
    }
}
