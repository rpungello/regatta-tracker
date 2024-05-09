<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('regattas.list') }}">{{ __('Regattas') }}</a></li>
            <li><a href="{{ route('regattas.edit', $regatta) }}">{{ $regatta->name }}</a></li>
            <li>{{ $event->getDescription() }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="time" label="{{ __('Time') }}" type="time"/>
        <x-select wire:model="race_type_id" :options="$raceTypes" label="{{ __('Race Type') }}"
                  placeholder="- Select a Type -"/>
        <x-select wire:model="gender_id" :options="$genders" label="{{ __('Gender') }}"
                  placeholder="- Select a Gender -"/>
        <x-select wire:model="event_class_id" :options="$eventClasses" label="{{ __('Event Class') }}"
                  placeholder="- Select a Class -"/>
        <x-select wire:model="boat_class_id" :options="$boatClasses" :option-label="'code'"
                  label="{{ __('Boat Class') }}" placeholder="- Select a Class -"/>
        <x-input wire:model="name" label="{{ __('Name') }}"/>
        <x-input wire:model="code" label="{{ __('Code') }}"/>
        <x-input wire:model="distance" label="{{ __('Distance') }}" suffix="m" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>

    <x-table :headers="$entryHeaders" :rows="$event->entries">
        @scope('cell_team', $entry)
        <x-team-badge :team="$entry->team" :entry="$entry" />
        @endscope

        @scope('actions', $entry)
        <div class="flex flex-row">
            <x-button icon="o-pencil" link="{{ route('entries.edit', $entry) }}" />
            <x-button icon="o-trash" wire:click="removeEntry({{ $entry->getKey() }})"/>
        </div>
        @endscope
    </x-table>

    <x-button link="{{ route('events.add-entry', ['event' => $event]) }}" label="{{ __('Add Entry') }}"
              class="btn-primary"/>
</div>
