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

    #[Validate(['nullable', 'int', 'min:0'])]
    public ?int $default_distance;

    public function mount(Regatta $regatta): void
    {
        $this->regatta = $regatta;
        $this->name = $regatta->name;
        $this->date = $regatta->date->format('Y-m-d');
        $this->default_distance = $regatta->default_distance;
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
    }

    private function getEventHeaders(): array
    {
        return [
            ['key' => 'time', 'label' => 'Time'],
            ['key' => 'name', 'label' => 'Name', 'class' => 'hidden xl:table-cell'],
            ['key' => 'raceType.name', 'label' => 'Race Type', 'class' => 'hidden lg:table-cell'],
            ['key' => 'gender.name', 'label' => 'Gender'],
            ['key' => 'eventClass.name', 'label' => 'Event Class'],
            ['key' => 'boatClass.code', 'label' => 'Boat Class'],
            ['key' => 'code', 'label' => 'Code', 'class' => 'hidden xl:table-cell'],
            ['key' => 'distance', 'label' => 'Distance', 'class' => 'hidden xl:table-cell'],
            ['key' => 'entries', 'label' => 'Entries'],
        ];
    }
}
