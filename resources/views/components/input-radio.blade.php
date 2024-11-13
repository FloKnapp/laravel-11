
<label class="block cursor-pointer relative flex items-center space-x-4 p-4 sm:p-6 bg-gray-200 rounded-lg text-gray-900 dark:text-dark-600 font-bold">

    <!-- Checkbox-Icon (linker Bereich) -->
    <span class="w-6 h-6 flex items-center justify-center rounded-full border-2 border-gray-400 transition-colors duration-200">
        <input type="radio" class="hidden peer" name="{{ $name }}" value="{{ $value }}" {{ $value === old($name) ? 'checked' : '' }} />
        <span class="w-3 h-3 rounded-full bg-gray-600 opacity-0 peer-checked:opacity-100 transition-opacity transition-200"></span>
    </span>

    <!-- Text der Kategorie -->
    <span>{{ $label }}</span>

</label>

