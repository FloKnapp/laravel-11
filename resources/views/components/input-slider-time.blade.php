<div class="w-full relative block relative grid grid-cols-3 col-1-xl gap-3 items-center space-x-4 p-4 sm:p-6 bg-gray-200 rounded-lg text-gray-900 dark:text-gray-200 dark:bg-gray-700 font-lighter text-shadow-0" x-data="stopwatch()">

    <div class="flex justify-items-center items-center col-span-2">

        <div class="flex items-center mt-0 mr-4">
            <div @click="startStopwatch" x-show="!isRunning" class="cursor-pointer px-4 py-2 bg-blue-500 text-white rounded text-center">⯈</div>
            <div @click="stopStopwatch" x-show="isRunning" class="cursor-pointer px-4 py-2 bg-red-500 text-white rounded text-center">⯀</div>
            <div @click="resetStopwatch" class="cursor-pointer ml-2 px-3 py-2 bg-gray-500 text-white rounded text-center">⭯</div>
        </div>

        <input type="range" name="{{ $name }}" x-on:input="timeElapsed = $event.target.value" id="seizure-duration" min="0" max="600" step="5" value="{{ old($name, 0) }}" class="w-full mt-2">

    </div>

    <!-- Label -->
    <span id="duration-display" class="whitespace-nowrap text-sm font-light text-right" style="font-feature-settings: 'tnum'" x-text="formatDuration(timeElapsed)"></span>

    @push('scripts')

        <script>
            const slider = document.getElementById('seizure-duration');
            const display = document.getElementById('duration-display');

            document.addEventListener('DOMContentLoaded', () => {
                if (slider.value > 0) {
                    display.textContent = stopwatch().formatDuration(slider.value);
                } else {
                    display.textContent = `0 Sekunden`;
                }
            });

            function stopwatch() {
                return {
                    timeElapsed: parseInt(slider.value),  // Gemessene Zeit in Sekunden
                    isRunning: false, // Status der Stoppuhr
                    timerInterval: null,

                    // Startet die Stoppuhr
                    startStopwatch() {
                        this.isRunning = true;
                        this.timerInterval = setInterval(() => {
                            this.timeElapsed++;
                            slider.value = this.timeElapsed;
                        }, 1000);
                    },

                    // Stoppuhr anhalten
                    stopStopwatch() {
                        this.isRunning = false;
                        clearInterval(this.timerInterval);
                    },

                    // Stoppuhr zurücksetzen
                    resetStopwatch() {
                        this.stopStopwatch();
                        this.timeElapsed = 0;
                        this.initialTime = 0;
                        slider.value = 0;
                    },

                    // Formatierte Anzeige der Zeit (Minuten und Sekunden)
                    formatDuration(seconds) {
                        const minutes = Math.floor(seconds / 60);
                        const remainingSeconds = seconds % 60;
                        return minutes > 0
                            ? (`${minutes} Minuten ${remainingSeconds < 10 ? '0' : ''}${remainingSeconds} Sekunden`)
                            : `${remainingSeconds} Sekunden`;
                    }
                };
            }
        </script>

    @endpush
</div>
