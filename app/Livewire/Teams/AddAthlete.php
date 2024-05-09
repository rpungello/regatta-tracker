<?php

namespace App\Livewire\Teams;

use App\Models\Gender;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AddAthlete extends Component
{
    public Team $team;

    #[Validate(['required', 'exists:genders,id'])]
    public int $gender_id;

    #[Validate(['required', 'string'])]
    public string $name_first;

    #[Validate(['required', 'string'])]
    public string $name_last;

    public function render(): View
    {
        return view('livewire.teams.add-athlete', [
            'genders' => Gender::orderBy('name')->get(),
        ]);
    }

    public function save(): void
    {
        $this->team->athletes()->create(
            $this->validate()
        );

        $this->redirectRoute('teams.edit', $this->team);
    }
}
