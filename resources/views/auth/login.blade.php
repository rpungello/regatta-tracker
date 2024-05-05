<x-layouts.base>
    <div class="w-screen h-screen flex items-center justify-center">
        <div class="max-w-md w-full">
            <h1 class="text-center text-2xl">{{ config('app.name') }}</h1>
            <x-form action="{{ route('login') }}" method="post">
                @csrf

                <x-input label="Email" type="email" name="email" error-field="email"/>
                <x-input label="Password" type="password" name="password" error-field="password"/>

                <x-button label="Log In" class="btn-primary" type="submit"/>
            </x-form>
        </div>
    </div>
</x-layouts.base>
