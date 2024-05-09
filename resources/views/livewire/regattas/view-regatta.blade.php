@php use App\Enums\Priority; @endphp
<div>
    <div class="flex flex-col items-center mb-4">
        <a href="{{ route('regattas.edit', $regatta) }}">
            <h1 class="text-2xl text-center">{{ $regatta->name }}</h1>
        </a>
        <h2 class="opacity-50">{{ $regatta->date->format('l, F j, Y') }}</h2>
    </div>

    <div class="flex flex-col space-y-4">
        @foreach($regatta->events()->orderBy('time')->orderBy('id')->get() as $event)
            <x-card>
                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-col">
                        @if($event->getPriority() === Priority::High)
                            <strong class="text-error">{{ $event->getDescription() }}</strong>
                        @else
                            <span>{{ $event->getDescription() }}</span>
                        @endif
                        @isset($event->name)
                            <span class="opacity-60">{{ $event->name }}</span>
                        @endisset
                        <span class="opacity-60">{{ $event->time->format('g:ia') }}</span>
                        @isset($event->race_type_id)
                            <span class="opacity-60">{{ $event->raceType?->name }}</span>
                        @endisset
                        @isset($event->distance)
                            <span class="opacity-60">{{ $event->distance }}m</span>
                        @endisset
                    </div>
                    <div class="flex flex-col space-y-2">
                        @foreach($event->entries()->orderBy('bow_number')->get() as $entry)
                            <a class="cursor-pointer" wire:click="toggleComplete({{ $entry->getKey() }})">
                                <x-team-badge :team="$entry->team" :entry="$entry"/>
                            </a>
                        @endforeach
                    </div>
                </div>
            </x-card>

            @if(! $event->isLastEvent())
                <div
                    class="flex flex-row items-center space-x-2 @if($event->getMinutesUntilNextEvent() >= 30) text-success @elseif ($event->getMinutesUntilNextEvent() === 0) text-warning @endif">
                    <x-icon name="o-clock"/>
                    <span>{{ $event->getTimeUntilNextEvent() }}</span>
                </div>
            @endif
        @endforeach
    </div>
</div>
