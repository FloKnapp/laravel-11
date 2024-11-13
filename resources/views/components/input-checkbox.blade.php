<label class="relative block cursor-pointer relative flex items-center space-x-4 p-4 sm:p-6 bg-gray-200 rounded-lg text-gray-900 dark:text-dark-600 font-bold">

    <input type="checkbox" class="hidden peer" name="{{ $name }}" value="{{ $value }}" {{ in_array($value, old(str_replace(['[', ']'], '', $name), [])) ? 'checked' : '' }} />

    <!-- Checkbox-Container -->
    <span class="absolute w-6 h-6 left-0 sm:left-2 flex items-center justify-center rounded border-2 border-gray-400 peer-checked:bg-gray-600 peer-checked:border-transparent transition-colors duration-200"></span>

    <!-- Checkbox-Icon -->
    <svg class="absolute text-white top-4 sm:top-6 sm:top-6 left-0 sm:left-2 w-6 h-6 opacity-0 peer-checked:opacity-100 transition-opacity duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
    </svg>

    <!-- Label -->
    <span class="pl-4 sm:pl-6 whitespace-nowrap">{{ $label }}</span>

</label>
