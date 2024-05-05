<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventClassRequest;
use App\Models\EventClass;

class EventClassController extends Controller
{
    public function index()
    {
        return EventClass::all();
    }

    public function store(EventClassRequest $request)
    {
        return EventClass::create($request->validated());
    }

    public function show(EventClass $eventClass)
    {
        return $eventClass;
    }

    public function update(EventClassRequest $request, EventClass $eventClass)
    {
        $eventClass->update($request->validated());

        return $eventClass;
    }

    public function destroy(EventClass $eventClass)
    {
        $eventClass->delete();

        return response()->json();
    }
}
