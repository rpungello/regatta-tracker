<x-layouts.base>
    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible="" class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="p-5 pt-3" />

            {{-- MENU --}}
            <x-menu activate-by-route="">

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <x-button icon="o-power" type="submit" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff" no-wire-navigate="" />
                            </form>
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="{{ __('Regattas') }}" icon="o-calendar" link="{{ route('regattas.list') }}" />
                <x-menu-item title="{{ __('Teams') }}" icon="o-user-group" link="{{ route('teams.list') }}" />
                <x-menu-item title="{{ __('Genders') }}" icon="o-user-plus" link="{{ route('genders.list') }}" />
                <x-menu-item title="{{ __('Event Classes') }}" icon="o-adjustments-horizontal" link="{{ route('event-classes.list') }}" />
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />
</x-layouts.base>
