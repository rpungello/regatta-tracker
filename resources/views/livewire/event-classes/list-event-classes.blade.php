<div>
    <div class="text-sm breadcrumbs">
        <ul>
            <li>{{ __('Event Classes') }}</li>
        </ul>
    </div>

    <x-table :headers="$headers" :rows="$classes">
        @scope('cell_created_at', $class)
        {{ $class->created_at->diffForHumans() }}
        @endscope

        @scope('actions', $class)
        <div class="flex flex-row">
            <x-button icon="o-pencil" link="{{ route('event-classes.edit', ['class' => $class]) }}"/>
        </div>
        @endscope
    </x-table>

    <x-button link="{{ route('event-classes.create') }}" label="{{ __('Create') }}" class="btn-primary hidden md:inline-flex"/>
</div>
