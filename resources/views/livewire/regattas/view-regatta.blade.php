@php use App\Enums\Priority; @endphp
<div>
    <header class="flex flex-row items-center justify-center mb-4">
        <h1 class="text-2xl">{{ $regatta->name }}</h1>
        <x-button class="opacity-50" link="{{ route('regattas.edit', $regatta) }}" icon="o-pencil" />
    </header>

    <div class="flex flex-col space-y-4">
        @foreach($regatta->events()->orderBy('time')->get() as $event)
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
                    </div>
                    <div class="flex flex-col space-y-2">
                        @foreach($event->entries()->orderBy('bow_number')->get() as $entry)
                            <a class="cursor-pointer" wire:click="toggleComplete({{ $entry->getKey() }})">
                                <x-team-badge :team="$entry->team" :bow-number="$entry->bow_number"
                                              :notes="$entry->notes" :complete="$entry->complete"/>
                            </a>
                        @endforeach
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</div>
