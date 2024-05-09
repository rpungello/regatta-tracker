<?php

namespace App\Http\Controllers;

use App\Http\Requests\RaceTypeRequest;
use App\Models\RaceType;

class RaceTypeController extends Controller
{
    public function index()
    {
        return RaceType::all();
    }

    public function store(RaceTypeRequest $request)
    {
        return RaceType::create($request->validated());
    }

    public function show(RaceType $raceType)
    {
        return $raceType;
    }

    public function update(RaceTypeRequest $request, RaceType $raceType)
    {
        $raceType->update($request->validated());

        return $raceType;
    }

    public function destroy(RaceType $raceType)
    {
        $raceType->delete();

        return response()->json();
    }
}
