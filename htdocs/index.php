<?php

# Fehlersichtbatkeit php
error_reporting(-1);
ini_set("display_errors", 1);

session_start();

# Pfadkontanten
define("PATH_ABS", "../");
global $user_notifications;


# Verbindungen
require_once (PATH_ABS . "app/core/Autoload.php");
require_once (PATH_ABS . "app/config/Settings.php");
require_once (PATH_ABS . "app/config/log/LogFile.php");
//require_once (PATH_ABS . "app/config/errorhandling/ErrorHandle.php");
require_once (PATH_ABS . "vendor/autoload.php");


\app\core\Autoload::register();

$GLOBALS['logFile'] = new \app\config\log\LogFile("errorlog");
set_exception_handler(array("\app\config\\exceptions\ExceptionHandler", "handleException"));
set_error_handler(array("\\app\\config\\errorhandling\\ErrorHandle", "error"));

$app = new app\core\App();