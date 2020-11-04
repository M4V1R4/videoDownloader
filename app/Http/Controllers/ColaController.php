<?php

namespace App\Http\Controllers;

use App\Cola;
use Illuminate\Http\Request;
Use App;
use App\Http\Controllers\Auth;

class ColaController extends Controller
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
        $colas =Cola::All();
        $colas = Cola::where('user_id', $id)->get();
        return view('home', compact('colas'));

        
        
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
        $nuevoCola = new Cola;
        $nuevoCola->url = $request->url;
        $nuevoCola->user_id = auth()->user()->id;
        $nuevoCola->format = $request->format;
        $nuevoCola->state = 'Procesado';
        $nuevoCola->save();
        return back();

                        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Colas  $Colas
     * @return \Illuminate\Http\Response
     */
    public function show(Colas $Colas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Colas  $Colas
     * @return \Illuminate\Http\Response
     */
    public function edit(Colas $Colas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Colas  $Colas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cola $Colas)
    {
        $model = Cola::where('id', $id)->get()[0];
        $model->state = $request->state;
        $model->update();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Colas  $Colas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cola $Cola)
    {
    
        $Cola->delete();
        return back();
    }
}
