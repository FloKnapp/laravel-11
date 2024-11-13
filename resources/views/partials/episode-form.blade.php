<form action="{{ route('episode.store') }}" method="post" class="px-4 sm:px-8 py-6">

    <h2 class="text-gray-900 dark:text-gray-400 text-2xl">Episode eintragen</h2>

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
        <legend class="py-3 text-gray-900 dark:text-gray-400">Intensität</legend>
        <x-input-slider name="intensity" labelStart="0%" labelEnd="100%" value="1" />
        <x-input-error :messages="$errors->get('intensity')" />
    </fieldset>

    <fieldset class="mt-3">
        <legend class="py-3 text-gray-900 dark:text-gray-400">Symptome</legend>
        <div class="grid grid-cols-2 gap-4">
            <x-input-checkbox name="symptoms[]" value="aura" label="{{ __('aura') }}" />
            <x-input-checkbox name="symptoms[]" value="unconsciousness" label="{{ __('unconsciousness') }}" />
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

    <fieldset class="mt-3">
        <legend class="py-3 text-gray-900 dark:text-gray-400">Dauer</legend>
        <x-input-slider-time name="duration" />
        <x-input-error :messages="$errors->get('duration')" />
    </fieldset>

    <x-hr />

    <div class="flex justify-end">
        <x-simple-primary-button>Speichern & schließen</x-simple-primary-button>
    </div>

</form>
