<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenderRequest;
use App\Models\Gender;

class GenderController extends Controller
{
    public function index()
    {
        return Gender::all();
    }

    public function store(GenderRequest $request)
    {
        return Gender::create($request->validated());
    }

    public function show(Gender $gender)
    {
        return $gender;
    }

    public function update(GenderRequest $request, Gender $gender)
    {
        $gender->update($request->validated());

        return $gender;
    }

    public function destroy(Gender $gender)
    {
        $gender->delete();

        return response()->json();
    }
}
