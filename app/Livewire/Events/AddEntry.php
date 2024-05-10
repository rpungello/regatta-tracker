<?php

namespace App\Livewire\Events;

use App\Enums\Priority;
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

    #[Validate(['required'])]
    public Priority $priority;

    #[Validate(['string', 'nullable'])]
    public ?string $notes;

    public function mount(): void
    {
        $this->priority = Priority::Normal;
    }

    public function render(): View
    {
        return view('livewire.events.add-entry', [
            'teams' => Team::orderBy('name')->get(),
            'priorities' => Priority::toSelectArray(),
        ]);
    }

    public function save(): void
    {
        $this->redirectRoute(
            'entries.edit',
            $this->event->entries()->create($this->validate())
        );
    }
}
