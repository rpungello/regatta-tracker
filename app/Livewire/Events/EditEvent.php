<?php

namespace App\Livewire\Events;

use App\Models\BoatClass;
use App\Models\Event;
use App\Models\EventClass;
use App\Models\Gender;
use App\Models\RaceType;
use App\Models\Regatta;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditEvent extends Component
{
    public Event $event;

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

    public function mount(Event $event): void
    {
        $this->event = $event;
        $this->regatta = $event->regatta;

        $this->name = $event->name;
        $this->code = $event->code;
        $this->distance = $event->distance;
        $this->time = $event->time->format('H:i');
        $this->race_type_id = $event->race_type_id;
        $this->gender_id = $event->gender_id;
        $this->event_class_id = $event->event_class_id;
        $this->boat_class_id = $event->boat_class_id;
    }

    public function render(): View
    {
        return view('livewire.events.edit-event', [
            'raceTypes' => RaceType::orderBy('name')->get(),
            'genders' => Gender::orderBy('name')->get(),
            'eventClasses' => EventClass::orderBy('name')->get(),
            'boatClasses' => BoatClass::orderBy('code')->get(),
            'entryHeaders' => $this->getEntryHeaders(),
        ]);
    }

    private function getEntryHeaders(): array
    {
        return [
            ['key' => 'team', 'label' => 'Team'],
            ['key' => 'bow_number', 'label' => 'Bow #'],
            ['key' => 'priority', 'label' => 'Priority'],
            ['key' => 'notes', 'label' => 'Notes'],
        ];
    }

    public function save(bool $redirect = false): void
    {
        $this->event->update(array_merge(
            $this->validate(),
            ['time' => "{$this->regatta->date->format('Y-m-d')} $this->time"]
        ));

        if ($redirect) {
            $this->redirectRoute(
                'regattas.edit',
                $this->regatta
            );
        }
    }

    public function removeEntry(int $entryId): void
    {
        $this->event->entries()->find($entryId)->delete();
        $this->event->refresh();
    }
}
