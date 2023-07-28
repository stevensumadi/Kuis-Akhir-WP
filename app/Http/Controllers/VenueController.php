<?php

namespace App\Http\Controllers;

use App\Models\venue;
use App\Http\Requests\StorevenueRequest;
use App\Http\Requests\UpdatevenueRequest;

class VenueController extends Controller
{
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
     * @param  \App\Http\Requests\StorevenueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorevenueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(venue $venue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(venue $venue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatevenueRequest  $request
     * @param  \App\Models\venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatevenueRequest $request, venue $venue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(venue $venue)
    {
        //
    }
}
