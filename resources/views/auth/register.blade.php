<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-slate-100 dark:bg-slate-900 py-6 sm:py-12">
        <div class="w-full max-w-7xl p-8 space-y-8 bg-white dark:bg-slate-800 shadow-md rounded-lg">
            <div class="flex justify-center">
                <x-authentication-card-logo />
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <x-label for="first_name" value="{{ __('First Name') }}" />
                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus />
                    </div>

                    <div>
                        <x-label for="last_name" value="{{ __('Last Name') }}" />
                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                    </div>

                    <div>
                        <x-label for="other_name" value="{{ __('Other Name') }}" />
                        <x-input id="other_name" class="block mt-1 w-full" type="text" name="other_name" :value="old('other_name')" required autofocus />
                    </div>

                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    </div>

                    <div>
                        <x-label for="address" value="{{ __('Address') }}" />
                        <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                    </div>

                    <div>
                        <x-label for="phone" value="{{ __('Phone') }}" />
                        <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required />
                    </div>

                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div>
                        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a class="underline text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-slate-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button type="submit" class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
