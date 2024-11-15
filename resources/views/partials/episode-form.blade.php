<form action="{{ route('episode.store') }}" method="post" class="relative px-4 sm:px-8 py-6">

    <h2 class="text-gray-900 dark:text-gray-400 text-2xl py-2">Episode eintragen</h2>

    <x-hr />

    @csrf

    <fieldset>
        <legend class="py-3 pt-0 text-gray-900 dark:text-gray-400">Art des Anfalls</legend>
        <div class="grid grid-cols-2 gap-4">
            <x-input-radio name="type" value="absence" label="{{ __('absence') }}" />
            <x-input-radio name="type" value="tonic" label="{{ __('tonic') }}" />
        </div>
        <x-input-error :messages="$errors->get('type')" />
    </fieldset>

    <fieldset class="mt-3">
        <legend class="py-3 text-gray-900 dark:text-gray-400">Symptome</legend>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-checkbox name="symptoms[aura]" value="aura" label="{{ __('aura') }}" x-on:change="$dispatch('show-additional', 'symptoms[aura][timing]')" />
                <x-input-additional name="symptoms[aura][timing]" />
                <x-input-error :messages="$errors->get('symptoms.aura.timing')" />
            </div>
            <div>
                <x-input-checkbox name="symptoms[unconsciousness]" value="unconsciousness" label="{{ __('unconsciousness') }}" x-on:change="$dispatch('show-additional', 'symptoms[unconsciousness][timing]')" />
                <x-input-additional name="symptoms[unconsciousness][timing]" />
                <x-input-error :messages="$errors->get('symptoms.unconsciousness.timing')" />
            </div>
        </div>
        <x-input-error :messages="$errors->get('symptoms')" />
    </fieldset>

    <fieldset class="mt-3">
        <legend class="py-3 text-gray-900 dark:text-gray-400">Auslöser</legend>
        <div class="grid grid-cols-3 gap-4">
            <x-input-checkbox name="triggers[]" value="menstruation" label="{{ __('menstruation') }}" />
            <x-input-checkbox name="triggers[]" value="sleep_deprivation" label="{{ __('sleep_deprivation') }}" />
            <x-input-checkbox name="triggers[]" value="nothing" label="{{ __('nothing') }}" />
        </div>
        <x-input-error :messages="$errors->get('triggers')" />
    </fieldset>

    <div x-data="{moreVisible: false}">

        <div class="w-full text-right p-3 pt-5 underline hover:no-underline cursor-pointer" x-on:click="$dispatch('more-options')" x-show="!moreVisible">weitere Optionen</div>

        <div x-on:more-options.window="moreVisible = true" x-on:less-options.window="moreVisible = false" x-show="moreVisible">

            <fieldset class="mt-3">
                <legend class="py-3 text-gray-900 dark:text-gray-400">Dauer</legend>
                <x-input-slider-time name="duration" />
                <x-input-error :messages="$errors->get('duration')" />
            </fieldset>

            <fieldset class="mt-3">
                <legend class="py-3 text-gray-900 dark:text-gray-400">Intensität</legend>
                <x-input-slider name="intensity" labelStart="0%" labelEnd="100%" value="1" />
                <x-input-error :messages="$errors->get('intensity')" />
            </fieldset>

            <fieldset class="mt-3">
                <legend class="py-3 text-gray-900 dark:text-gray-400">Datum</legend>
                <x-input-datetime name="published_at" />
                <x-input-error :messages="$errors->get('published_at')" />
            </fieldset>

            <div class="w-full text-right p-3 pt-5 underline hover:no-underline cursor-pointer" x-on:click="$dispatch('less-options')">weniger Optionen</div>

        </div>

    </div>

    <x-hr />

    <div class="flex justify-end">
        <x-simple-primary-button>Speichern & schließen</x-simple-primary-button>
    </div>

</form>
