@props([
    'team',
    'entry',
])

<div class="rounded-xl px-2.5 py-1.5 space-x-1 flex flex-row items-center transition-opacity duration-200 @if(isset($entry) && $entry->complete) opacity-40 @endif"
     style="background-color: #{{ $team->brand_color_primary }}; color: #{{ $team->brand_color_secondary }};">
    @if(isset($entry))
        <span class="mr-2">{{ $entry->bow_number }}</span>
    @endif

    <div class="flex flex-col items-center font-bold flex-grow">
        <span class="text-center">{{ $team->name }}</span>
        @isset($entry)
            @foreach($entry->athletes as $athlete)
                <span class="text-xs opacity-50 text-center">{{ $athlete->name }}</span>
            @endforeach
        @endisset
    </div>

    @isset($entry)
        <x-icon name="s-check-badge" :class="$entry->complete === false ? 'opacity-0' : ''" />
    @endisset

</div>
