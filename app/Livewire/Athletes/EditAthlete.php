<?php

namespace App\Livewire\Athletes;

use App\Models\Athlete;
use App\Models\Gender;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditAthlete extends Component
{
    public Athlete $athlete;

    #[Validate(['required', 'exists:genders,id'])]
    public int $gender_id;

    #[Validate(['required', 'string'])]
    public string $name_first;

    #[Validate(['required', 'string'])]
    public string $name_last;

    public function mount(): void
    {
        $this->gender_id = $this->athlete->gender_id;
        $this->name_first = $this->athlete->name_first;
        $this->name_last = $this->athlete->name_last;
    }

    public function render(): View
    {
        return view('livewire.athletes.edit-athlete', [
            'genders' => Gender::orderBy('name')->get(),
        ]);
    }

    public function save(): void
    {
        $this->athlete->update(
            $this->validate()
        );

        $this->redirectRoute('teams.edit', $this->athlete->team);
    }
}
