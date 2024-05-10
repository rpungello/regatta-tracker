<?php

namespace App\Livewire\Venues;

use App\Models\Venue;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateVenue extends Component
{
    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['required', 'string'])]
    public string $state;

    public function render(): View
    {
        return view('livewire.venues.create-venue');
    }

    public function save(): void
    {
        Venue::create(
            $this->validate()
        );

        $this->redirectRoute('venues.list');
    }
}
