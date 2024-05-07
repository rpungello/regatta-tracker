<?php

namespace App\Livewire\Regattas;

use App\Models\Regatta;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditRegatta extends Component
{
    public Regatta $regatta;

    #[Validate(['required'])]
    public string $name;

    #[Validate(['required', 'date'])]
    public string $date;

    public function mount(Regatta $regatta): void
    {
        $this->regatta = $regatta;
        $this->name = $regatta->name;
        $this->date = $regatta->date->format('Y-m-d');
    }

    public function render(): View
    {
        return view('livewire.regattas.edit-regatta', [
            'eventHeaders' => $this->getEventHeaders(),
        ]);
    }

    public function save(): void
    {
        $this->regatta->update($this->validate());

        $this->redirectRoute('regattas.list');
    }

    private function getEventHeaders(): array
    {
        return [
            ['key' => 'time', 'label' => 'Time'],
            ['key' => 'name', 'label' => 'Name'],
            ['key' => 'gender.name', 'label' => 'Gender'],
            ['key' => 'eventClass.name', 'label' => 'Event Class'],
            ['key' => 'boatClass.code', 'label' => 'Boat Class'],
            ['key' => 'code', 'label' => 'Code'],
            ['key' => 'entries', 'label' => 'Entries'],
        ];
    }
}
