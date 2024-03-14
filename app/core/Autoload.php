<?php

namespace app\core;

use \app\config\Settings;

/*
  - Systemclass Autoload
  - Autoloading
 */

class Autoload {

    static function register() {
        spl_autoload_register("self::myloader");
    }

    static function myloader($class) {
        $explode = explode("\\", $class);
        $path = Settings::ABS_PATH . implode(Settings::DIRECTORY_SEPARATOR, $explode) . ".php";
        if (file_exists($path)) {
            require_once $path;
        }
    }

}
