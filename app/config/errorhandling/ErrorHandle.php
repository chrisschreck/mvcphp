<?php

namespace app\config\errorhandling;

use Error;

class ErrorHandle {

	//Code - Siehe LogMessage.php
    const MODE = 1;

    public static function error($fehlercode, $fehlertext, $fehlerdatei, $fehlerzeile) {

        if (!(error_reporting() & $fehlercode)) {
            return false;
	    }
        $fehlertext = htmlspecialchars($fehlertext);

	    switch ($fehlercode) {
            case E_USER_ERROR:
                echo "<b>PHP_ERROR</b> [$fehlercode] $fehlertext<br />\n";
                echo "  Fataler Fehler in Zeile $fehlerzeile in der Datei $fehlerdatei";
                echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
                break;

            case E_USER_WARNING:
                echo "<b>PHP_WARNING</b> [$fehlercode] $fehlertext<br />\n";
                break;

            case E_USER_NOTICE:
                echo "<b>PHP_NOTICE</b> [$fehlercode] $fehlertext<br />\n";
                break;

            default:
                echo "UNKNOWN_ERROR: [$fehlercode] $fehlertext<br />\n";
                break;
	    }
    }
}