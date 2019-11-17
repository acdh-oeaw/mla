<?php

namespace App\Http\Controllers\Api;

use App\Monastery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonasteryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Monastery::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Monastery  $monastery
     * @return \Illuminate\Http\Response
     */
    public function show(Monastery $monastery)
    {
        $monastery->codices;
        return $monastery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Monastery  $monastery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monastery $monastery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Monastery  $monastery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monastery $monastery)
    {
        //
    }
}
