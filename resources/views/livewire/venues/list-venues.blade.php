<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li>{{ __('Venues') }}</li>
        </ul>
    </div>

    <x-table :headers="$headers" :rows="$venues">
        @scope('cell_created_at', $venue)
        {{ $venue->created_at->diffForHumans() }}
        @endscope

        @scope('actions', $venue)
        <div class="flex flex-row">
            <x-button icon="o-pencil" link="{{ route('venues.edit', ['venue' => $venue]) }}"/>
        </div>
        @endscope
    </x-table>

    <x-button link="{{ route('venues.create') }}" label="{{ __('Create') }}" class="btn-primary hidden md:inline-flex"/>
</div>
