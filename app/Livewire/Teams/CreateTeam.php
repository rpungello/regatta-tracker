<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use App\Models\TeamType;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateTeam extends Component
{
    #[Validate(['required', 'unique:teams'])]
    public string $name = '';

    #[Validate('required', 'exists:team_types,id')]
    public int $type = 0;

    #[Validate(['regex:/[0-9a-fA-F]{6}/'])]
    public ?string $brandPrimaryColor = null;

    #[Validate(['regex:/[0-9a-fA-F]{6}/'])]
    public ?string $brandSecondaryColor = null;

    public function mount(): void
    {
        $this->type = TeamType::first()->getKey();
    }

    public function render(): View
    {
        return view('livewire.teams.create-team', [
            'types' => TeamType::all(),
        ]);
    }

    public function save(): void
    {
        $this->validate();

        Team::create([
            'name' => $this->name,
            'team_type_id' => $this->type,
            'brand_color_primary' => $this->brandPrimaryColor,
            'brand_color_secondary' => $this->brandSecondaryColor,
        ]);

        $this->redirect(route('teams.list'));
    }
}
