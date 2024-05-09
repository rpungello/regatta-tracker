<?php

namespace App\Livewire\EventClasses;

use App\Models\EventClass;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditEventClass extends Component
{
    public EventClass $class;

    #[Validate(['required', 'string'])]
    public string $name;

    #[Validate(['nullable', 'regex:/[0-9a-fA-F]{6}/'])]
    public ?string $color;

    public function mount(): void
    {
        $this->name = $this->class->name;
        $this->color = $this->class->color;
    }

    public function render(): View
    {
        return view('livewire.event-classes.edit-event-class');
    }

    public function save(): void
    {
        $this->class->update(
            $this->validate()
        );

        $this->redirectRoute('event-classes.list');
    }
}
