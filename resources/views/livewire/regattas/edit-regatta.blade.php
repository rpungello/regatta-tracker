<div>
    <h1 class="text-2xl font-bold mb-4">{{ __('Update Regatta') }}</h1>
    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-input wire:model="date" label="{{ __('Date') }}" type="date" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}" />
    </x-form>
</div>
