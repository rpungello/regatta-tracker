<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('regattas.list') }}">{{ __('Regattas') }}</a></li>
            <li><a href="{{ route('regattas.edit', $entry->event->regatta) }}">{{ $entry->event->regatta->name }}</a>
            </li>
            <li><a href="{{ route('events.edit', $entry->event) }}">{{ $entry->event->getDescription() }}</a></li>
            <li>{{ $entry->team->name }}</li>
        </ul>
    </div>

    <x-form class="max-w-md mb-4" wire:submit.prevent="save">
        <x-select wire:model="team_id" :options="$teams" label="{{ __('Team') }}" placeholder="- Select a Team -"/>
        <x-input wire:model="bow_number" label="{{ __('Bow #') }}" type="number" min="0"/>
        <x-select wire:model="priority" :options="$priorities" label="{{ __('Priority') }}"/>
        <x-input wire:model="notes" label="{{ __('Notes') }}"/>

        <x-choices
            label="Athletes"
            wire:model="athleteIds"
            :options="$athleteSearch"
            searchable
        >
            @scope('item', $athlete)
            <x-list-item :item="$athlete" value="name_last" sub-value="name_first"/>
            @endscope

            @scope('selection', $athlete)
            {{ $athlete->name_first }} {{ $athlete->name_last }}
            @endscope
        </x-choices>

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
