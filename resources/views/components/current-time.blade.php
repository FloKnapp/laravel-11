<div {{ $attributes->merge(['class' => 'text-center']) }}>

    <span id="current-time" style="font-feature-settings: 'tnum'">{{ date('D, d.m.Y, H:i:s') }} Uhr</span>

    <script>
        (() => {
            const time = document.getElementById('current-time');

            const formattedDate = (date) => {
                // Monate und Wochentage in gewünschter Form festlegen
                const days = ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];
                const months = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

                // Teile des Datums extrahieren
                const dayOfWeek = days[date.getDay()];
                const day = String(date.getDate()).padStart(2, '0'); // Tag mit führender Null
                const month = months[date.getMonth()];               // Monat mit führender Null
                const year = date.getFullYear();
                const hours = String(date.getHours()).padStart(2, '0');  // Stunde mit führender Null
                const minutes = String(date.getMinutes()).padStart(2, '0'); // Minuten mit führender Null
                const seconds = String(date.getSeconds()).padStart(2, '0') // Sekunden mit führender Null;

                // Datum formatieren
                return `${dayOfWeek}, ${day}.${month}.${year}, ${hours}:${minutes}:${seconds} Uhr`;
            };

            const update = () => {
                const date = formattedDate(new Date());

                if (date !== time.innerText) {
                    time.innerHTML = date;
                }

                setTimeout(update, 50);
            };

            update();

        })();
    </script>

</div>
