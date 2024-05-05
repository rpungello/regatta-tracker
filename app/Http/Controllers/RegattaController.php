<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegattaRequest;
use App\Models\Regatta;

class RegattaController extends Controller
{
    public function index()
    {
        return Regatta::all();
    }

    public function store(RegattaRequest $request)
    {
        return Regatta::create($request->validated());
    }

    public function show(Regatta $regatta)
    {
        return $regatta;
    }

    public function update(RegattaRequest $request, Regatta $regatta)
    {
        $regatta->update($request->validated());

        return $regatta;
    }

    public function destroy(Regatta $regatta)
    {
        $regatta->delete();

        return response()->json();
    }
}
