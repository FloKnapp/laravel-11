<x-default-layout>

    <div class="w-full sm:max-w-5xl">

        @php
            $flashMessage = session('status');
        @endphp

        <div class="absolute">{{ __($flashMessage) }}</div>

        <div class="p-4 sm:py-6 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">

            <x-data-container class="text-gray-900 dark:text-gray-200">

                <div class="grid grid-cols-3 justify-between items-center">
                    <x-headline-primary>{{ __('Epilepsy-Tracker') }}</x-headline-primary>
                    <x-current-time />
                    <div class="flex gap-2 justify-end">
                        <x-theme-switch />
                        <x-simple-primary-button x-on:click="$dispatch('open-modal', 'show-form')">Neuer Eintrag</x-simple-primary-button>
                    </div>
                </div>

                <x-modal name="show-form" :show="$errors->any()">
                    <x-episode-form></x-episode-form>
                </x-modal>

            </x-data-container>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div id="episodes" class="pt-5">

                <h2 class="text-2xl text-left pl-8">{{ __('Recent entries') }}</h2>

                @foreach ($episodes as $episode)
                    <x-episode-item :episode="$episode" />
                @endforeach

            </div>

            <x-calendar :events="$events" />

        </div>



    </div>

</x-default-layout>
