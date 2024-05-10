<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('venues.list') }}">{{ __('Venues') }}</a></li>
            <li>{{ $venue->name }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-input wire:model="state" label="{{ __('State') }}" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
