<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoatClassRequest;
use App\Models\BoatClass;

class BoatClassController extends Controller
{
    public function index()
    {
        return BoatClass::all();
    }

    public function store(BoatClassRequest $request)
    {
        return BoatClass::create($request->validated());
    }

    public function show(BoatClass $boatClass)
    {
        return $boatClass;
    }

    public function update(BoatClassRequest $request, BoatClass $boatClass)
    {
        $boatClass->update($request->validated());

        return $boatClass;
    }

    public function destroy(BoatClass $boatClass)
    {
        $boatClass->delete();

        return response()->json();
    }
}
