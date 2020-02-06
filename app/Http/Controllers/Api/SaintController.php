<?php

namespace App\Http\Controllers\Api;

use App\Saint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SaintController extends Controller
{

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->request->input('month')) {
            return Saint::where('date', 'like', '%'.$this->request->input('month').'.')->get();
        } else if($this->request->input('char')) {
            return Saint::where('name', 'like', strtoupper($this->request->input('char')).'%')->orWhere('name', 'like', strtolower($this->request->input('char')).'%')->orderBy('name', 'asc')->get();
        } else return Saint::all();
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
     * @param  \App\Saint  $saint
     * @return \Illuminate\Http\Response
     */
    public function show(Saint $saint)
    {
        return $saint;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Saint  $saint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Saint $saint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Saint  $saint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Saint $saint)
    {
        //
    }
}
