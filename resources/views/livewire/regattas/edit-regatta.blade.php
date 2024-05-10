@php use Carbon\Carbon; @endphp
<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('regattas.list') }}">{{ __('Regattas') }}</a></li>
            <li>{{ $regatta->name }}</li>
        </ul>
    </div>

    <x-form class="max-w-md mb-4" wire:submit.prevent="save">
        <x-input wire:model="name" label="{{ __('Name') }}"/>
        <x-input wire:model="date" label="{{ __('Date') }}" type="date"/>
        <x-input wire:model="default_distance" label="{{ __('Default Distance') }}" suffix="m" type="number" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>

    <x-button link="{{ route('events.create', ['regatta' => $regatta]) }}" label="{{ __('Add Event') }}"
              class="btn-primary"/>

    <x-table :headers="$eventHeaders" :rows="$regatta->events">
        @scope('cell_time', $event)
        {{ Carbon::parse($event->time)->format('g:ia') }}
        @endscope

        @scope('cell_entries', $event)
        <div class="flex flex-col space-y-2">
            @foreach($event->entries as $entry)
                <x-team-badge :team="$entry->team" :entry="$entry" />
            @endforeach
        </div>
        @endscope

        @scope('actions', $event)
        <x-button link="{{ route('events.edit', ['event' => $event]) }}" icon="o-pencil"/>
        @endscope
    </x-table>

    <x-button link="{{ route('events.create', ['regatta' => $regatta]) }}" label="{{ __('Add Event') }}"
              class="btn-primary"/>
</div>
