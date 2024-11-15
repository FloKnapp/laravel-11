<x-default-layout>

    <div class="w-full sm:max-w-5xl">

        @php
            $flashMessage = session('status');
        @endphp

        <div class="p-4 sm:py-6 sm:p-8 bg-white dark:bg-gray-800 overflow-hidden sm:rounded-lg">

            <x-data-container class="text-gray-900 dark:text-gray-200">

                <div class="grid grid-cols-1 sm:grid-cols-3 justify-between items-center relative">
                    <x-headline-primary class="hidden sm:block">{{ __('Epilepsy-Tracker') }}</x-headline-primary>
                    <x-current-time class="hidden sm:block" />

                    <x-flash-message>{{ __($flashMessage) }}</x-flash-message>

                    <div class="flex gap-2 justify-end">
                        <x-reload-button />
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

                <h2 class="text-xl text-left pl-8">
                    @if (count($episodes))
                        {{ __('Recent entries') }}
                    @else
                        {{ __('No entries') }}
                    @endif
                </h2>

                @foreach ($episodes as $episode)
                    <x-episode-item :episode="$episode" />
                @endforeach

            </div>

            @if (count($episodes))
                <x-calendar :events="$events" class="min-h-80" />
            @endif

        </div>



    </div>

</x-default-layout>
