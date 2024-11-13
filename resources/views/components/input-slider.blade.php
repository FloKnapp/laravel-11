<div x-data="{ value: {{ old($name, $value) }} }" class="relative block relative flex items-center space-x-4 p-4 sm:p-6 bg-gray-200 rounded-lg text-gray-900 dark:text-dark-600 font-bold">

    <input x-model="value" name="{{ $name }}" type="range" step="1" min="0" max="10" class="w-full" value="{{ old($name, $value) }} /">

    <!-- Label -->
    <span class="w-20 pl-4 sm:pl-6 ">
        <span class="whitespace-nowrap text-lg font-bold" x-text="value">{{ $labelEnd }}</span>
    </span>

</div>
