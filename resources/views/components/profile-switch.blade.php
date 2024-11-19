<div x-data="{loggedIn: @JS(auth()->check()), login_visible: false}" x-on:click="login_visible = !login_visible" {{ $attributes->merge(['class' => 'relative px-4 bg-gray-300 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-100 cursor-pointer']) }}>

    <div class="text-xs flex flex-col">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 25 25" fill="currentColor" class="margin-0" :class="loggedIn ? 'text-blue-400' : 'text-gray-200'">
            <circle cx="12" cy="9" r="4" />
            <path d="M4 20c0-4 4-7 8-7s8 3 8 7H4z" />
        </svg>

        <span class="text-xs p-0">
            @if (auth()->check())
                {{ auth()->user()->name }}
            @else
                anon
            @endif
        </span>

    </div>

    <div x-show="login_visible" class="absolute min-w-52 w-fit z-10 box-content left-0 p-5 bg-gray-300 dark:bg-gray-700 rounded-b-md rounded-r-md text-gray-900 dark:text-gray-100">

        @if (auth()->check())

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <x-primary-button>Logout</x-primary-button>

            </form>

        @else

            <form action="{{ route('login') }}" method="post" class="h-fit">

                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-input-text id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-input-text id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex flex-col items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}

                    </x-primary-button>
                </div>
            </form>

        @endif

    </div>

</div>
