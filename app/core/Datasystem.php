<?php

namespace app\core;

/*
  - Helper Class Datasystem
  - All Functions for Datasystem
 */

class Datasystem {

    function createFile($filepath, $filename, $filetype, $filecontent = false) {
        if (!file_exists($filepath . $filename . $filetype)) {
            touch($filepath . $filename . $filetype);
        }
        if ($filecontent != false) {
            $open = fopen($filepath . $filename . $filetype, "r+");
            fwrite($open, $filecontent);
            fclose($open);
        }
    }

    function getFile($file) {
        $open = fopen($file, "r+");
        while ($read = fgets($open)) {
            $data[] = $read;
        }
        fclose($open);
        return $data;
    }

    static function getDirectoryFiles($dir) {
        $open = opendir($dir);
        while ($read = readdir($open)) {
            if ($read != "." && $read != ".." && $read != "DS_STORE") {
                $files[] = $read;
            }
        }
        return $files;
    }

}
