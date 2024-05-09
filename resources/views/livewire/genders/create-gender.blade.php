<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('genders.list') }}">{{ __('Genders') }}</a></li>
            <li>{{ __('Create') }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-input wire:model="color" label="{{ __('Color') }}" />
        <x-checkbox wire:model="pluralize" label="{{ __('Pluralize') }}" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
