<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddEntry extends Component
{
    public Event $event;

    #[Validate(['required', 'exists:teams,id'])]
    public int $team_id;

    #[Validate(['required', 'integer', 'min:1'])]
    public int $bow_number;

    #[Validate(['string', 'nullable'])]
    public ?string $notes;

    public function render(): View
    {
        return view('livewire.events.add-entry', [
            'teams' => Team::orderBy('name')->get(),
        ]);
    }

    public function save(): void
    {
        $this->event->entries()->create($this->validate());

        $this->redirectRoute('events.edit', $this->event);
    }
}
