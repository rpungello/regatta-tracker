<x-layouts.app>
    <h1 class="text-center text-2xl">{{ $regatta->name }}</h1>

    <div class="flex flex-col space-y-4">
        @foreach($regatta->events()->orderBy('time')->get() as $event)
            <x-card>
                <div class="flex flex-row justify-between">
                    <div class="flex flex-col">
                        @if($event->getPriority() === \App\Enums\Priority::High)
                            <strong class="text-error">{{ $event->getDescription() }}</strong>
                        @else
                            <span>{{ $event->getDescription() }}</span>
                        @endif
                        <span class="opacity-60">{{ $event->time->format('g:ia') }}</span>
                    </div>
                    <div class="flex flex-col">
                        @foreach($event->entries()->orderBy('bow_number')->get() as $entry)
                            <x-team-badge :team="$entry->team" :bow-number="$entry->bow_number"/>
                        @endforeach
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
</x-layouts.app>
