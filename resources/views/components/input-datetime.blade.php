@props([
    'name',
    'label' => null
])

<label>
    <input {{ $attributes->merge(['class' => 'w-full p-3 rounded-lg dark:border-0 text-gray-600 dark:text-gray-200 dark:bg-gray-700 font-lighter text-shadow-0']) }} type="datetime-local" name="{{ $name }}" value="{{ old($name) }}"/>
    {{ $label }}
</label>
