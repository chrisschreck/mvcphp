<?php

namespace app\config\exceptions;

use app\config\Settings;
use app\config\log\LogMessage;
use Exception;

/**
 * Description of ExceptionHandler
 *
 * @author schreckc
*/

class ExceptionHandler {

    protected static $exceptionObject;
    protected $userMessage;

    const LOG_CODE = 0;                                                     #Stands for Exception

    public static function handleException($exception) {

        self::$exceptionObject = $exception;
        if ( Settings::is_debug() )
        {
            echo self::getExceptionString();
            $log = new LogMessage(self::LOG_CODE, $exception->getMessage(),$exception->getFile(),$exception->getLine());
            $GLOBALS['logFile']->addMessage($log);
            //Log::writeErrorLog(self::getDevResponse($exception)); @todo: In neues Format ändern --> New LogMessage --> LogFile
        } else {
            //Log::writeErrorLog(self::getDevResponse($exception));
            $message = new LogMessage();
            header("Location: /error"); #UMleiten to Errorlog
        }
    }


    static function getExceptionString(): string
    {
        return "[".date('Y/m/d H:i:s')."]: ".self::$exceptionObject->getMessage()." in ".self::$exceptionObject->getFile()." in Line ".self::$exceptionObject->getLine();
    }

}
