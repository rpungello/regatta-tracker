<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li><a href="{{ route('regattas.list') }}">{{ __('Regattas') }}</a></li>
            <li><a href="{{ route('regattas.edit', $event->regatta) }}">{{ $event->regatta->name }}</a></li>
            <li><a href="{{ route('events.edit', $event) }}">{{ $event->getDescription() }}</a></li>
            <li>{{ __('Add Entry') }}</li>
        </ul>
    </div>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-select wire:model="team_id" :options="$teams" label="{{ __('Team') }}" placeholder="- Select a Team -"/>
        <x-input wire:model="bow_number" label="{{ __('Bow #') }}" type="number" min="0"/>

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
