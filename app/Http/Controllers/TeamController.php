<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;

class TeamController extends Controller
{
    public function index()
    {
        return Team::all();
    }

    public function store(TeamRequest $request)
    {
        return Team::create($request->validated());
    }

    public function show(Team $team)
    {
        return $team;
    }

    public function update(TeamRequest $request, Team $team)
    {
        $team->update($request->validated());

        return $team;
    }

    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json();
    }
}
