<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li>{{ __('Teams') }}</li>
        </ul>
    </div>

    <x-table :headers="$headers" :rows="$teams" :sort-by="$sortBy">
        @scope('cell_name', $team)
        <x-team-badge :team="$team" />
        @endscope

        @scope('cell_athletes', $team)
        {{ number_format($team->athletes()->count()) }}
        @endscope

        @scope('actions', $team)
        <x-button icon="o-pencil" link="{{ route('teams.edit', ['team' => $team]) }}"/>
        @endscope
    </x-table>

    <x-button link="{{ route('teams.create') }}" label="{{ __('Add Team') }}" class="btn-primary"/>
</div>
