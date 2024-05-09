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
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

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
    public int $event_class_id;

    #[Validate(['required', 'exists:boat_classes,id'])]
    public int $boat_class_id;

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount(): void
    {
        $this->regatta = Regatta::findOrFail(request()->get('regatta'));
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

    public function save(): void
    {
        $this->redirectRoute(
            'events.edit',
            $this->regatta->events()->create(
                array_merge(
                    $this->validate(),
                    ['time' => "{$this->regatta->date->format('Y-m-d')} $this->time"]
                )
            )
        );
    }
}
