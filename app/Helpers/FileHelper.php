<?php

if (!function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');
        
        $i = 0;
        while ($bytes >= 1024) {
            $bytes /= 1024;
            $i++;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }
}

?>
