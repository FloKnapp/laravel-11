<?php

if (!function_exists('formatDuration')) {
    function formatDuration($seconds) {
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        return sprintf('%d Min. %02d Sek.', $minutes, $remainingSeconds);
    }
}
