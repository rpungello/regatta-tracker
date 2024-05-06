<?php

namespace App\Livewire\Regattas;

use App\Models\Regatta;
use App\Models\Venue;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateRegatta extends Component
{
    #[Validate('required')]
    public string $name = '';

    #[Validate(['required', 'exists:venues,id'])]
    public ?int $venue_id = null;

    #[Validate(['required', 'date'])]
    public ?string $date = null;
    public function render(): View
    {
        return view('livewire.regattas.create-regatta', [
            'venues' => Venue::orderBy('name')->get(),
        ]);
    }

    public function save(): void
    {
        $regatta = Regatta::create($this->validate());
        $this->redirectRoute('regattas.edit', $regatta);
    }
}
