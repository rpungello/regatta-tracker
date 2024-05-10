<?php

namespace App\Livewire\Venues;

use App\Models\Venue;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditVenue extends Component
{
    public Venue $venue;

    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['required', 'string'])]
    public string $state;

    public function mount(): void
    {
        $this->name = $this->venue->name;
        $this->state = $this->venue->state;
    }

    public function render(): View
    {
        return view('livewire.venues.edit-venue');
    }

    public function save(): void
    {
        $this->venue->update(
            $this->validate()
        );

        $this->redirectRoute('venues.list');
    }
}
