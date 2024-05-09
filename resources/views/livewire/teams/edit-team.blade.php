<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('teams.list') }}">{{ __('Teams') }}</a></li>
            <li>{{ $team->name }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-select wire:model="type" :options="$types" label="{{ __('Type') }}" />
        <x-input wire:model="brandPrimaryColor" label="{{ __('Primary Color') }}" prefix="#" />
        <x-input wire:model="brandSecondaryColor" label="{{ __('Secondary Color') }}" prefix="#" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}" />
    </x-form>
</div>
