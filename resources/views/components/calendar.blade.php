<div {{ $attributes->only('class')->merge(['class' => 'dark:bg-gray-800 rounded-lg p-8 my-5']) }}>

    <div id="calendar" class="text-gray-900"></div>

    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendarEl = document.getElementById('calendar');
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'multiMonthYear',
                    firstDay: '1',
                    locale: 'de',
                    height: '100%',
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        meridiem: false
                    },
                    // headerToolbar: {
                    //     start: 'title',
                    //     end: 'dayGridMonth multiMonthYear prev next'
                    // },
                    buttonText: {
                        today: 'Heute',
                        month: 'Monat',
                        year: 'Jahr',
                        day: 'Tag'
                    },
                    moreLinkText: (n) => {
                        return '+' + n + ' mehr';
                    },
                    //slotMinTime: '8:00:00',
                    //slotMaxTime: '19:00:00',
                    events: @json($events),
                });
                calendar.render();
            });
        </script>
    @endpush

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
    @endpush
</div>


