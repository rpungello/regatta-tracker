<?php

namespace App\Livewire\Events;

use App\Models\BoatClass;
use App\Models\EventClass;
use App\Models\Gender;
use App\Models\RaceType;
use App\Models\Regatta;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateEvent extends Component
{
    public Regatta $regatta;

    #[Validate(['string', 'nullable'])]
    public ?string $name = null;

    #[Validate(['string', 'nullable'])]
    public ?string $code = null;

    #[Validate(['string', 'nullable'])]
    public ?string $distance = null;

    #[Validate(['required', 'date_format:H:i'])]
    public string $time = '';

    #[Validate(['nullable', 'exists:race_types,id'])]
    public ?int $race_type_id;

    #[Validate(['required', 'exists:genders,id'])]
    public int $gender_id;

    #[Validate(['required', 'exists:event_classes,id'])]
    public ?int $event_class_id;

    #[Validate(['required', 'exists:boat_classes,id'])]
    public int $boat_class_id;

    public function mount(): void
    {
        $this->race_type_id = $this->regatta->default_race_type_id;
        $this->event_class_id = $this->regatta->default_event_class_id;
        $this->distance = $this->regatta->default_distance;
    }

    public function render(): View
    {
        return view('livewire.events.create-event', [
            'raceTypes' => RaceType::orderBy('name')->get(),
            'genders' => Gender::orderBy('name')->get(),
            'eventClasses' => EventClass::orderBy('name')->get(),
            'boatClasses' => BoatClass::orderBy('code')->get(),
        ]);
    }

    public function save(bool $addEntry = true): void
    {
        $event = $this->regatta->events()->create(
            array_merge(
                $this->validate(),
                ['time' => "{$this->regatta->date->format('Y-m-d')} $this->time"]
            )
        );

        if ($addEntry) {
            $this->redirectRoute(
                'events.add-entry',
                $event
            );
        } else {
            $this->redirectRoute(
                'events.edit',
                $event
            );
        }
    }
}
