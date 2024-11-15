<x-default-layout>

    <div class="w-full sm:max-w-2xl dark:bg-gray-800 rounded-lg p-6">

        <h1 class="text-2xl">Details</h1>

        <x-hr />

        <div class="grid grid-cols-2">
            <span class="w-6">Zeit:</span>
            <span>{{ $episode->created_at->format('D, d.m.Y, H:i:s') }} Uhr</span>
        </div>

        <div class="grid grid-cols-2 mt-2">
            <span>Art des Anfalls:</span>
            <span>{{ __($episode->types()->first()->name) }}</span>
        </div>

        <div class="grid grid-cols-2 mt-2">
            <span>Symptome:</span>
            <span>
            @foreach ($episode->symptoms as $symptom)
                {{ __($symptom->symptom->name) }}@if ($episode->symptoms->count() > 1 && $episode->symptoms->last() === $symptom), @endif
            @endforeach
            </span>
        </div>

        <div class="grid grid-cols-2 mt-2">
            <span>Auslöser:</span>
            <span>
            @foreach ($episode->triggers as $trigger)
                {{ __($trigger->name) }}@if ($episode->triggers->count() > 1 && $episode->triggers->last() !== $trigger), @endif
            @endforeach
            </span>
        </div>

        <div class="grid grid-cols-2 mt-2">
            <span>Dauer:</span>
            <span>{{ formatDuration($episode->duration ?? 0) }}</span>
        </div>

        <div class="grid grid-cols-2 mt-2">
            <span>Intensität:</span>
            <span>{{ $episode->intensity }}</span>
        </div>

        <x-hr />

        <div class="flex justify-center items-center text-sm hover:underline">
            <a href="{{ route('home') }}">Zurück zur Startseite</a>
        </div>


    </div>

</x-default-layout>
