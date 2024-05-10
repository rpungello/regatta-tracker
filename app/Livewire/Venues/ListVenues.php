<?php

namespace App\Livewire\Venues;

use App\Models\Venue;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListVenues extends Component
{
    public function render(): View
    {
        return view('livewire.venues.list-venues', [
            'headers' => $this->headers(),
            'venues' => $this->venues(),
        ]);
    }

    private function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'state', 'label' => 'State'],
            ['key' => 'created_at', 'label' => 'Created', 'sortBy' => 'created_at', 'class' => 'hidden md:table-cell'],
        ];
    }

    private function venues(): Collection
    {
        return Venue::orderBy('name')->get();
    }
}
