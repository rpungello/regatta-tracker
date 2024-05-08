@props([
    'team',
    'bowNumber',
    'notes',
])

<div class="rounded-full px-1.5 py-1 space-x-1 flex flex-row items-center"
     style="background-color: #{{ $team->brand_color_primary }}; color: #{{ $team->brand_color_secondary }};">
    @isset($bowNumber)
        <span class="mr-2">{{ $bowNumber }}</span>
    @endisset

    <div class="flex flex-col font-bold">
        <span>{{ $team->name }}</span>
        @isset($notes)
            <span class="text-xs">{{ $notes }}</span>
        @endisset
    </div>

</div>
