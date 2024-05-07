<div>
    <h1 class="text-2xl font-bold mb-4">{{ __('Add Entry') }}</h1>
    <h2 class="text-md mb-4 opacity-80">{{ $event->getDescription() }}</h2>

    <x-form class="max-w-md" wire:submit.prevent="save">
        <x-select wire:model="team_id" :options="$teams" label="{{ __('Team') }}" placeholder="- Select a Team -" />
        <x-input wire:model="bow_number" label="{{ __('Bow #') }}" type="number" min="0" />

        <x-button type="submit" class="btn-primary" label="{{ __('Save') }}"/>
    </x-form>
</div>
