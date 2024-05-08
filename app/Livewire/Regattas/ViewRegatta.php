<?php

namespace App\Livewire\Regattas;

use App\Models\Entry;
use App\Models\Regatta;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ViewRegatta extends Component
{
    public Regatta $regatta;

    public function render(): View
    {
        return view('livewire.regattas.view-regatta');
    }

    public function toggleComplete(Entry $entry): void
    {
        $entry->update([
            'complete' => ! $entry->complete,
        ]);
    }
}
