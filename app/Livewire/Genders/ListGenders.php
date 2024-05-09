<?php

namespace App\Livewire\Genders;

use App\Models\Gender;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListGenders extends Component
{
    public function render(): View
    {
        return view('livewire.genders.list-genders', [
            'headers' => $this->headers(),
            'genders' => $this->genders(),
        ]);
    }

    private function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'created_at', 'label' => 'Created', 'sortBy' => 'created_at', 'class' => 'hidden md:table-cell'],
        ];
    }

    private function genders(): Collection
    {
        return Gender::orderBy('name')->get();
    }
}
