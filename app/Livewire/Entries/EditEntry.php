<?php

namespace App\Livewire\Entries;

use App\Enums\Priority;
use App\Models\Athlete;
use App\Models\Entry;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
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

    public array $athleteIds = [];

    public Collection $athleteSearch;

    public function mount(): void
    {
        $this->team_id = $this->entry->team_id;
        $this->bow_number = $this->entry->bow_number;
        $this->priority = $this->entry->priority;
        $this->notes = $this->entry->notes;
        $this->athleteSearch = $this->entry->team->athletes()
            ->orderBy('name_last')
            ->orderBy('name_first')
            ->get();

        $this->athleteIds = $this->entry->athletes()->pluck('id')->toArray();
    }

    public function render(): View
    {
        return view('livewire.entries.edit-entry', [
            'teams' => Team::orderBy('name')->get(),
            'priorities' => Priority::toSelectArray(),
        ]);
    }

    public function search(string $name): void
    {
        $this->athleteSearch = Athlete::search($name)->get();
        $this->athleteSearch = $this->athleteSearch->merge(Athlete::whereIn('id', $this->athleteIds)->get());
    }

    public function save(): void
    {
        $this->entry->update($this->validate());

        $this->redirectRoute('events.edit', $this->entry->event);
    }

    public function updatedAthleteIds(): void
    {
        $this->entry->athletes()->sync($this->athleteIds);
    }
}
