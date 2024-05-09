<?php

namespace App\Livewire\EventClasses;

use App\Models\EventClass;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListEventClasses extends Component
{
    public function render(): View
    {
        return view('livewire.event-classes.list-event-classes', [
            'headers' => $this->headers(),
            'classes' => $this->classes(),
        ]);
    }

    private function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'created_at', 'label' => 'Created', 'sortBy' => 'created_at'],
        ];
    }

    private function classes(): Collection
    {
        return EventClass::orderBy('name')->get();
    }
}
