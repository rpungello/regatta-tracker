<?php

namespace App\Livewire\Regattas;

use App\Models\Regatta;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListRegattas extends Component
{
    public array $sortBy = [
        'column' => 'date',
        'direction' => 'desc',
    ];

    public function render(): View
    {
        return view('livewire.regattas.list-regattas', [
            'headers' => $this->headers(),
            'regattas' => $this->regattas(),
        ]);
    }

    private function headers(): array
    {
        return [
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'date', 'label' => 'Date'],
            ['key' => 'created_at', 'label' => 'Created', 'sortBy' => 'created_at'],
        ];
    }

    private function regattas(): Collection
    {
        return Regatta::where('date', '>=', now()->subMonths(2))
            ->orderBy(...array_values($this->sortBy))->get();
    }
}
