<x-auth-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Episodes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" x-data="{currentEpisodeId: null}">

                    @php
                        $episodeCount = count($episodes ?? 0);
                    @endphp

                    <x-headline-primary>
                        {{ $episodeCount == 1 ? $episodeCount . ' Episode' : $episodeCount . ' Episoden' }}
                    </x-headline-primary>

                    <x-hr />

                    <table class="mt-3 w-full">
                        <tr>
                            <th class="p-2 px-3 text-left">ID</th>
                            <th class="p-2 px-3 text-left">Datum</th>
                            <th class="p-2 px-3 text-left">Typ</th>
                            <th class="p-2 px-3 text-left">Symptome</th>
                            <th class="p-2 px-3 text-left">Auslöser</th>
                            <th class="p-2 px-3 text-left">Optionen</th>
                        </tr>
                    @foreach ($episodes as $episode)
                        <tr class="dark:bg-gray-800 odd:dark:bg-gray-700 rounded-sm">
                            <td class="p-3 text-sm">{{ $episode->id }}</td>
                            <td class="p-3 text-sm">{{ $episode->created_at->format('d.m.Y, H:i') }} Uhr</td>
                            <td class="p-3 text-sm">{{ __($episode->types->first()->name) }}</td>
                            <td class="p-3">
                                @foreach ($episode->symptoms as $symptom)
                                    <span class="text-sm">{{ __($symptom->symptom->name) }}</span>@if ($episode->symptoms->last() !== $symptom),@endif
                                @endforeach
                            <td class="p-3">
                                @foreach ($episode->triggers as $trigger)
                                    <span class="text-sm">{{ __($trigger->name) }}</span>@if ($episode->triggers->last() !== $trigger),@endif
                                @endforeach
                            </td>
                            <td class="flex items-center p-3 gap-2" x-data="{show: false, episodeId: '{{ $episode->id }}' }">
                                <a href="{{ route('episode.edit', ['id' => $episode->id]) }}" class="flex items-center p-2 rounded-sm dark:bg-gray-600 text-xs font-light">
                                    <i class="icon icon-pencil"></i>
                                </a>
                                <a x-on:click.prevent="currentEpisodeId = episodeId; $dispatch('open-modal', 'confirm-episode-delete')" href="{{ route('episode.delete', ['id' => $episode->id]) }}" class="flex items-center p-2 rounded-sm dark:bg-red-500 text-xs font-light">
                                    <i class="icon icon-bin2"></i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    </table>

                    <x-modal name="confirm-episode-delete" maxWidth="sm">

                        <div class="p-3 text-center">

                            <div class="p-3">
                                Sicher, dass Du die Episode löschen möchtest?
                            </div>

                            <x-hr />

                            <x-simple-primary-button x-on:click="window.location.href='/episode/delete/' + currentEpisodeId" class="bg-red-500">Löschen</x-simple-primary-button>
                            <x-simple-primary-button x-on:click="$dispatch('close-modal', 'confirm-episode-delete')">Abbrechen</x-simple-primary-button>

                        </div>

                    </x-modal>

                </div>
            </div>
        </div>
    </div>

</x-auth-layout>
