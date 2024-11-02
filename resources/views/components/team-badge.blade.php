@props([
    'team',
    'entry',
])

<div class="@if(isset($entry) && $entry->priority === \App\Enums\Priority::High) border-2 border-red-600 @endif rounded-xl px-2.5 py-1.5 space-x-1 flex flex-row items-center transition-opacity @if(isset($entry) && $entry->complete) opacity-40 @endif"
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
        @if($entry->complete)
            <x-icon name="s-check-badge" />
        @elseif($entry->priority === \App\Enums\Priority::High)
            <x-icon name="s-star" />
        @elseif ($entry->priority === \App\Enums\Priority::Low)
            <x-icon name="s-chevron-double-down" />
        @else
            <div class="w-5"></div>
        @endif
    @endisset

</div>
