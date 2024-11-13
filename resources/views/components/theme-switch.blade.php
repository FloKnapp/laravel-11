<button x-on:click="darkMode = !darkMode; localStorage.setItem('dark-mode', darkMode)" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 rounded-md text-gray-900 dark:text-gray-100">
    <span x-text="darkMode ? '☼︎' : '☽'"></span>
</button>
