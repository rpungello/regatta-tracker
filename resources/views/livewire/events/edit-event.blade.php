<div>
    <h1 class="text-2xl font-bold mb-2">{{ __('Edit Event') }}</h1>
    <h2 class="text-md mb-4 opacity-80">{{ $event->getDescription() }}</h2>
    <h2 class="text-md mb-4 opacity-80">{{ $regatta->name }} ({{ $regatta->date->format('l F j, Y') }})</h2>
    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="time" label="{{ __('Time') }}" type="time" />
        <x-select wire:model="gender_id" :options="$genders" label="{{ __('Gender') }}" placeholder="- Select a Gender -" />
        <x-select wire:model="event_class_id" :options="$eventClasses" label="{{ __('Event Class') }}" placeholder="- Select a Class -" />
        <x-select wire:model="boat_class_id" :options="$boatClasses" :option-label="'code'" label="{{ __('Boat Class') }}" placeholder="- Select a Class -" />
        <x-input wire:model="name" label="{{ __('Name') }}" />
        <x-input wire:model="code" label="{{ __('Code') }}" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}" />
    </x-form>

    <x-table :headers="$entryHeaders" :rows="$event->entries">
        @scope('cell_team', $entry)
        <x-team-badge :team="$entry->team" />
        @endscope

        @scope('actions', $entry)
        <x-button icon="o-trash" wire:click="removeEntry({{ $entry->getKey() }})" />
        @endscope
    </x-table>

    <x-button link="{{ route('events.add-entry', ['event' => $event]) }}" label="{{ __('Add Entry') }}" class="btn-primary"/>
</div>
