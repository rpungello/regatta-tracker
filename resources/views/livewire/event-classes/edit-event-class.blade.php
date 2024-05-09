<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('event-classes.list') }}">{{ __('Event Classes') }}</a></li>
            <li>{{ $class->name }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-input wire:model="color" label="{{ __('Color') }}" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
