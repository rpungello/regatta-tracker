<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li>{{ __('Genders') }}</li>
        </ul>
    </div>

    <x-table :headers="$headers" :rows="$genders" class="hidden md:table">
        @scope('cell_created_at', $gender)
        {{ $gender->created_at->diffForHumans() }}
        @endscope

        @scope('actions', $gender)
        <div class="flex flex-row">
            <x-button icon="o-pencil" link="{{ route('genders.edit', ['gender' => $gender]) }}"/>
        </div>
        @endscope
    </x-table>

    <x-button link="{{ route('genders.create') }}" label="{{ __('Create') }}" class="btn-primary hidden md:inline-flex"/>
</div>
