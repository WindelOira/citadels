<?php

namespace App\Helpers;

class HumanReadableFile {
  public static function bytesToHuman($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

    for($i = 0; $bytes > 1024; $i++) :
        $bytes /= 1024;
    endfor;

    return round($bytes, 2) .' '. $units[$i];
  }
}