<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use App\Models\TeamType;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditTeam extends Component
{
    public Team $team;

    public string $name;

    #[Validate('required', 'exists:team_types,id')]
    public int $type;

    #[Validate(['nullable', 'regex:/[0-9a-fA-F]{6}/'])]
    public ?string $brandPrimaryColor = '';

    #[Validate(['nullable', 'regex:/[0-9a-fA-F]{6}/'])]
    public ?string $brandSecondaryColor = '';

    public function mount(Team $team): void
    {
        $this->team = $team;
        $this->name = $team->name;
        $this->type = $team->team_type_id;
        $this->brandPrimaryColor = $team->brand_color_primary;
        $this->brandSecondaryColor = $team->brand_color_secondary;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('teams')->ignore($this->team->id),
            ]
        ];
    }

    public function render(): View
    {
        return view('livewire.teams.edit-team', [
            'types' => TeamType::all(),
        ]);
    }

    public function save(): void
    {
        $this->validate();

        $this->team->update([
            'name' => $this->name,
            'team_type_id' => $this->type,
            'brand_color_primary' => $this->brandPrimaryColor,
            'brand_color_secondary' => $this->brandSecondaryColor,
        ]);

        $this->redirect(route('teams.list'));
    }
}
