<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Models\Entry;

class EntryController extends Controller
{
    public function index()
    {
        return Entry::all();
    }

    public function store(EntryRequest $request)
    {
        return Entry::create($request->validated());
    }

    public function show(Entry $entry)
    {
        return $entry;
    }

    public function update(EntryRequest $request, Entry $entry)
    {
        $entry->update($request->validated());

        return $entry;
    }

    public function destroy(Entry $entry)
    {
        $entry->delete();

        return response()->json();
    }
}
