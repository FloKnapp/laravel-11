<div {{ $attributes->merge(['class' => 'w-full dark:bg-gray-800 rounded-lg mt-5 p-4 sm:p-8 text-gray-900 dark:text-gray-400']) }}>

    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 sm:gap-4 w-full">

        <div>
            <h2>Art</h2>
            <span class="text-xl text-gray-900 dark:text-gray-200">{{ __($episode->types()->first()->name) }}</span>
        </div>

        <div>
            <h2>Intensität</h2>
            <span class="text-xl text-gray-900 dark:text-gray-200">{{ __($episode->intensity) }}</span>
        </div>

        <div>
            <h2>Dauer</h2>
            <span class="text-xl text-gray-900 dark:text-gray-200">{{ formatDuration($episode->duration) }}</span>
        </div>

    </div>

    <div class="grid grid-cols-2 gap-2 sm:gap-6 w-full mt-5">

        <div>
            <h2>Symptome</h2>
            @foreach ($episode->symptoms as $symptom)
                <span class="text-base text-gray-900 dark:text-gray-200">{{ __($symptom->name) }}@if ($episode->symptoms->last() !== $symptom), @endif</span>
            @endforeach
        </div>

        <div>
            <h2>Auslöser</h2>
            @foreach ($episode->triggers as $trigger)
                <span class="text-base text-gray-900 dark:text-gray-200">{{ __($trigger->name) }}@if ($episode->triggers->last() !== $trigger), @endif</span>
            @endforeach
        </div>

    </div>

    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">

    <div class="flex w-full">
        <span class="text-xs">
            {{ $episode->created_at->format('D, d.m.Y, H:i:s') }} Uhr
        </span>
        <span></span>
    </div>

</div>
