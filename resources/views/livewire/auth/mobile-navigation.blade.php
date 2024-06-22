<div>
    @auth
        <x-responsive-nav-link href="{{ url('/dashboard') }}" :active="request()->routeIs('dashboard')"
            wire:navigate>
            Dashboard
        </x-responsive-nav-link>
    @else
        <x-responsive-nav-link href="{{ route('login') }}">
            Log in
        </x-responsive-nav-link>

        @if (Route::has('register'))
            <x-responsive-nav-link href="{{ route('register') }}" >
                Register
            </x-responsive-nav-link>
        @endif
    @endauth

</div>
