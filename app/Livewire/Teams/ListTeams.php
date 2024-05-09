<?php

namespace App\Livewire\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListTeams extends Component
{
    public array $sortBy = [
        'column' => 'name',
        'direction' => 'asc',
    ];

    public function render(): View
    {
        return view('livewire.teams.list-teams', [
            'headers' => $this->headers(),
            'teams' => $this->teams(),
        ]);
    }

    private function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'teamType.name', 'label' => 'Type', 'sortable' => false, 'class' => 'hidden md:table-cell'],
            ['key' => 'athletes', 'label' => 'Athletes', 'sortable' => false],
            ['key' => 'created', 'label' => 'Created', 'sortBy' => 'created_at', 'class' => 'hidden md:table-cell'],
        ];
    }

    private function teams(): Collection
    {
        return Team::orderBy(...array_values($this->sortBy))->get();
    }
}
