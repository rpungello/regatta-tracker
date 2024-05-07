@php use Carbon\Carbon; @endphp
<div>
    <h1 class="text-2xl font-bold mb-4">{{ __('Update Regatta') }}</h1>
    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}"/>
        <x-input wire:model="date" label="{{ __('Date') }}" type="date"/>

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>

    <x-table :headers="$eventHeaders" :rows="$regatta->events">
        @scope('cell_time', $event)
        {{ Carbon::parse($event->time)->format('g:ia') }}
        @endscope

        @scope('cell_entries', $event)
        <div class="flex flex-col space-y-2">
            @foreach($event->entries as $entry)
                <x-team-badge :team="$entry->team"/>
            @endforeach
        </div>
        @endscope

        @scope('actions', $event)
        <x-button link="{{ route('events.edit', ['event' => $event]) }}" icon="o-pencil"/>
        @endscope
    </x-table>

    <x-button link="{{ route('events.create', ['regatta' => $regatta]) }}" label="{{ __('Create') }}" class="btn-primary"/>
</div>
