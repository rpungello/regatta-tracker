<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li>{{ __('Teams') }}</li>
        </ul>
    </div>

    <x-table :headers="$headers" :rows="$teams" :sort-by="$sortBy">
        @scope('cell_name', $team)
        <span class="badge font-bold" style="background-color: #{{ $team->brand_color_primary }}; color: #{{ $team->brand_color_secondary }}">
            {{ $team->name }}
        </span>
        @endscope

        @scope('actions', $team)
        <x-button icon="o-pencil" link="{{ route('teams.edit', ['team' => $team]) }}"/>
        @endscope
    </x-table>

    <x-button link="{{ route('teams.create') }}" label="{{ __('Create') }}" class="btn-primary"/>
</div>
