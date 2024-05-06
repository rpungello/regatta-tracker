<div>
    <x-table :headers="$headers" :rows="$regattas" :sort-by="$sortBy">
        @scope('cell_date', $regatta)
        {{ $regatta->date->format('l F j, Y') }}
        @endscope

        @scope('cell_created_at', $regatta)
        {{ $regatta->created_at->diffForHumans() }}
        @endscope

        @scope('actions', $regatta)
        <x-button icon="o-pencil" link="{{ route('regattas.edit', ['regatta' => $regatta]) }}"/>
        @endscope
    </x-table>

    <x-button link="{{ route('regattas.create') }}" label="{{ __('Create') }}" class="btn-primary"/>
</div>
