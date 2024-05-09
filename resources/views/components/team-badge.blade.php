@props([
    'team',
    'entry',
])

<div class="rounded-xl px-2.5 py-1.5 space-x-1 flex flex-row items-center @if(isset($entry) && $entry->complete) opacity-40 @endif"
     style="background-color: #{{ $team->brand_color_primary }}; color: #{{ $team->brand_color_secondary }};">
    @if(isset($entry))
        @if($entry->complete)
            <x-icon name="o-check-badge" />
        @else
            <span class="mr-2">{{ $entry->bow_number }}</span>
        @endif
    @endif

    <div class="flex flex-col items-center font-bold flex-grow">
        <span class="text-center">{{ $team->name }}</span>
        @isset($entry)
            @foreach($entry->athletes as $athlete)
                <span class="text-xs opacity-50">{{ $athlete->name }}</span>
            @endforeach
        @endisset
    </div>

</div>
