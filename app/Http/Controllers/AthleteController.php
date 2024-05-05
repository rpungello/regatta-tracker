<?php

namespace App\Http\Controllers;

use App\Http\Requests\AthleteRequest;
use App\Models\Athlete;

class AthleteController extends Controller
{
    public function index()
    {
        return Athlete::all();
    }

    public function store(AthleteRequest $request)
    {
        return Athlete::create($request->validated());
    }

    public function show(Athlete $athlete)
    {
        return $athlete;
    }

    public function update(AthleteRequest $request, Athlete $athlete)
    {
        $athlete->update($request->validated());

        return $athlete;
    }

    public function destroy(Athlete $athlete)
    {
        $athlete->delete();

        return response()->json();
    }
}
