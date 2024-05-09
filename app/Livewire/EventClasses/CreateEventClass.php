<?php

namespace App\Livewire\EventClasses;

use App\Models\EventClass;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEventClass extends Component
{
    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['nullable', 'regex:/[0-9a-fA-F]{6}/'])]
    public ?string $color;

    public function render(): View
    {
        return view('livewire.event-classes.create-event-class');
    }

    public function save(): void
    {
        EventClass::create(
            $this->validate()
        );

        $this->redirectRoute('event-classes.list');
    }
}
