<div>
    <x-table :headers="$headers" :rows="$teams" :sort-by="$sortBy"></x-table>

    <x-button link="{{ route('teams.create') }}" label="{{ __('Create') }}" class="btn-primary" />
</div>
