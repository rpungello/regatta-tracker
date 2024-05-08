@props([
    'team',
    'bowNumber',
    'notes',
])

<div class="badge font-bold space-x-1" style="background-color: #{{ $team->brand_color_primary }}; color: #{{ $team->brand_color_secondary }};">
    @isset($bowNumber)
        <span>{{ $bowNumber }}</span>
        <span>|</span>
    @endisset
    <span>{{ $team->name }}</span>
    @isset($notes)
        <span>|</span>
        <span>{{ $notes }}</span>
    @endisset
</div>
