<?php

namespace App\Livewire\Regattas;

use App\Enums\Priority;
use App\Models\Entry;
use App\Models\Event;
use App\Models\Regatta;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;

class ViewRegatta extends Component
{
    public Regatta $regatta;

    public bool $excludeLowPriority = false;

    public function render(): View
    {
        return view('livewire.regattas.view-regatta');
    }

    public function toggleComplete(Entry $entry): void
    {
        $entry->update([
            'complete' => ! $entry->complete,
        ]);
    }

    public function getEvents(): Collection
    {
        $events = $this->getEventsBuilder()->get();

        if ($this->excludeLowPriority) {
            $events = $events->filter(function (Event $event) {
                return $event->getPriority() !== Priority::Low;
            });
        }

        return $events;
    }

    protected function getEventsBuilder(): Builder
    {
        return $this->regatta->events()->orderBy('time')->orderBy('id');
    }
}
