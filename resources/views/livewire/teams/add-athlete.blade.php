<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('teams.list') }}">{{ __('Teams') }}</a></li>
            <li><a href="{{ route('teams.edit', $team) }}">{{ $team->name }}</a></li>
            <li>{{ __('Add Athlete') }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-select wire:model="gender_id" :options="$genders" label="{{ __('Gender') }}" placeholder="- Select a Gender -"/>
        <x-input wire:model="name_first" label="First Name" />
        <x-input wire:model="name_last" label="Last Name" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
