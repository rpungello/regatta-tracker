<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('teams.list') }}">{{ __('Teams') }}</a></li>
            <li>{{ $team->name }}</li>
        </ul>
    </div>

    <x-form class="max-w-md mb-4" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}"/>
        <x-select wire:model="type" :options="$types" label="{{ __('Type') }}"/>
        <x-input wire:model="brandPrimaryColor" label="{{ __('Primary Color') }}" prefix="#"/>
        <x-input wire:model="brandSecondaryColor" label="{{ __('Secondary Color') }}" prefix="#"/>

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>

    <x-button class="btn-primary" link="{{ route('teams.add-athlete', ['team' => $team]) }}" label="Add Athlete"/>

    <x-table :headers="$athleteHeaders" :rows="$team->athletes()->orderBy('name_last')->orderBy('name_first')->get()">
        @scope('actions', $athlete)
        <div class="flex flex-row">
            <x-button icon="o-pencil" link="{{ route('athletes.edit', $athlete) }}"/>
            <x-button icon="o-trash" wire:click="removeAthlete({{ $athlete->getKey() }})"/>
        </div>
        @endscope
    </x-table>

    <x-button class="btn-primary" link="{{ route('teams.add-athlete', ['team' => $team]) }}" label="Add Athlete"/>
</div>
