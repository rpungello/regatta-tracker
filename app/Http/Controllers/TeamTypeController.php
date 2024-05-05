<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamTypeRequest;
use App\Models\TeamType;

class TeamTypeController extends Controller
{
    public function index()
    {
        return TeamType::all();
    }

    public function store(TeamTypeRequest $request)
    {
        return TeamType::create($request->validated());
    }

    public function show(TeamType $teamType)
    {
        return $teamType;
    }

    public function update(TeamTypeRequest $request, TeamType $teamType)
    {
        $teamType->update($request->validated());

        return $teamType;
    }

    public function destroy(TeamType $teamType)
    {
        $teamType->delete();

        return response()->json();
    }
}
