<?php

namespace App\Http\Controllers;

use App\SmCountry;
use Illuminate\Http\Request;

class SmCountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('PM');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\SmCountry  $smCountry
     * @return \Illuminate\Http\Response
     */
    public function show(SmCountry $smCountry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SmCountry  $smCountry
     * @return \Illuminate\Http\Response
     */
    public function edit(SmCountry $smCountry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SmCountry  $smCountry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SmCountry $smCountry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SmCountry  $smCountry
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmCountry $smCountry)
    {
        //
    }
}
