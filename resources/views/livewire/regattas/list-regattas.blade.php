<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li>{{ __('Regattas') }}</li>
        </ul>
    </div>

    <x-button link="{{ route('regattas.create') }}" label="{{ __('Add Regatta') }}" class="btn-primary hidden md:inline-flex"/>

    <div class="hidden md:block">
        <x-table :headers="$headers" :rows="$regattas" :sort-by="$sortBy">
            @scope('cell_date', $regatta)
            {{ $regatta->date->format('D, F j, Y') }}
            @endscope

            @scope('cell_created_at', $regatta)
            {{ $regatta->created_at->diffForHumans() }}
            @endscope

            @scope('actions', $regatta)
            <div class="flex flex-row">
                <x-button icon="o-eye" link="{{ route('regattas.view', ['regatta' => $regatta]) }}"/>
                <x-button icon="o-pencil" link="{{ route('regattas.edit', ['regatta' => $regatta]) }}"/>
            </div>
            @endscope
        </x-table>
    </div>

    <div class="block md:hidden">
        @foreach($regattas as $regatta)
            <x-list-item :item="$regatta" sub-value="short_date" link="{{ route('regattas.view', $regatta) }}" />
        @endforeach
    </div>


    <x-button link="{{ route('regattas.create') }}" label="{{ __('Add Regatta') }}" class="btn-primary hidden md:inline-flex"/>
</div>
