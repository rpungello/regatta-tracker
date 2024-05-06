<div>
    <h1 class="text-2xl font-bold mb-4">{{ __('Create Regatta') }}</h1>
    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-select wire:model="venue_id" :options="$venues" label="{{ __('Venue') }}" placeholder="- Select a Venue -" />
        <x-input wire:model="date" label="{{ __('Date') }}" type="date" />

        <x-button type="submit" class="btn-primary" label="{{ __('Create') }}" />
    </x-form>
</div>
