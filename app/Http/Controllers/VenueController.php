<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        return Venue::all();
    }

    public function store(VenueRequest $request)
    {
        return Venue::create($request->validated());
    }

    public function show(Venue $venue)
    {
        return $venue;
    }

    public function update(VenueRequest $request, Venue $venue)
    {
        $venue->update($request->validated());

        return $venue;
    }

    public function destroy(Venue $venue)
    {
        $venue->delete();

        return response()->json();
    }
}
