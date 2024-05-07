@props([
    'team'
])

<span class="badge font-bold" style="background-color: #{{ $team->brand_color_primary }}; color: #{{ $team->brand_color_secondary }};">
    {{ $team->name }}
</span>
