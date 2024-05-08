<?php

namespace App\Livewire\Entries;

use App\Enums\Priority;
use App\Models\Entry;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditEntry extends Component
{
    public Entry $entry;

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
        $this->team_id = $this->entry->team_id;
        $this->bow_number = $this->entry->bow_number;
        $this->priority = $this->entry->priority;
        $this->notes = $this->entry->notes;
    }

    public function render(): View
    {
        return view('livewire.entries.edit-entry', [
            'teams' => Team::orderBy('name')->get(),
            'priorities' => Priority::toSelectArray(),
        ]);
    }

    public function save(): void
    {
        $this->entry->update($this->validate());

        $this->redirectRoute('events.edit', $this->entry->event);
    }
}
