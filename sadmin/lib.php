<?php

function get_ram()
{
    if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
        exec('Powershell -C "systeminfo /fo CSV | ConvertFrom-Csv | convertto-json"', $output);
        $json = json_decode(implode("\n", $output), true);
        $totalram = $json['Total Physical Memory'];
        $totalram = str_replace('MB', '', $totalram) . "MB";
        $avram = $json['Available Physical Memory'];
        $avram = str_replace('MB', '', $avram) . "MB";
        return [$totalram, $avram];
    } else {
        $totalram = str_replace("\n", "", shell_exec('free -g | grep Mem | awk \'{print $2}\'')) . "GB";
        $avram = str_replace("\n", "", shell_exec('free -m | grep Mem | awk \'{print $4}\'')) . "MB";
        return [$totalram, $avram];
    }
}
