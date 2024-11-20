<div x-data="{loggedIn: @JS(auth()->check()), login_visible: @JS($errors->any(['login', 'password'])) }" :class="login_visible ? 'bg-white dark:bg-gray-800' : null" {{ $attributes->merge(['class' => 'relative px-4 bg-gray-200 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-100']) }}>

    <div x-on:click="login_visible = !login_visible" class="text-xs flex flex-col justify-between cursor-pointer">

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22" fill="currentColor" class="margin-0 h-7" :class="loggedIn ? 'text-blue-400' : 'text-gray-400 dark:text-gray-200'">
            <circle cx="12" cy="9" r="4" />
            <path d="M4 20c0-4 4-7 8-7s8 3 8 7H4z" />
        </svg>

        <div class="text-xs p-0 m-0 text-center">
            {{ auth()->check() ? trim(auth()->user()->name) : 'Login' }}
        </div>

    </div>

    <div x-show="login_visible" class="absolute min-w-52 w-fit z-10 box-content left-[-100%] p-3 bg-white dark:bg-gray-800 rounded-b-md rounded-r-md text-gray-900 dark:text-gray-100 shadow-2xl">

        <div class="flex justify-end items-center gap-3">
            @if(auth()->check())
                <div class="text-sm mr-auto">
                    <a class="underline hover:no-underline" href="{{ route('profile.index') }}">Zum Profil</a>
                </div>
            @else
                @if (Route::has('register'))
                    <a class="underline mr-auto text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                @endif
            @endif
            <x-reload-button />
            <x-theme-switch />
        </div>

        <x-hr class="mt-2" />

        @if (auth()->check())

            <div class="flex justify-between">
                <div class="text-sm">
                    Eingeloggt als:<br />
                    {{ auth()->user()->name }}
                </div>


            </div>

            <x-hr />

            <form action="{{ route('logout') }}" method="post" class="flex justify-end">
                @csrf
                <x-primary-button>Logout</x-primary-button>

            </form>

        @else

            <form action="{{ route('login') }}" method="post">

                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="login" :value="__('Login')" />
                    <x-input-text id="login" class="block mt-1 w-full" type="text" name="login" :value="old('login')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('login')" class="mt-2 text-sm" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-input-text id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center gap-2 mt-4 justify-between">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-simple-primary-button class="mt-3 py-2 whitespace-nowrap">
                        {{ __('Log in') }}
                    </x-simple-primary-button>

                </div>


            </form>

        @endif

    </div>

</div>
