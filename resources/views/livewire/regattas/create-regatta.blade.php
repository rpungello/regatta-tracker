<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('regattas.list') }}">{{ __('Regattas') }}</a></li>
            <li>{{ __('Create') }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-select wire:model="venue_id" :options="$venues" label="{{ __('Venue') }}" placeholder="- Select a Venue -" />
        <x-input wire:model="date" label="{{ __('Date') }}" type="date" />
        <x-input wire:model="default_distance" label="{{ __('Default Distance') }}" suffix="m" type="number" />

        <x-button type="submit" class="btn-primary" label="{{ __('Create') }}" />
    </x-form>
</div>
