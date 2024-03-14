<?php

namespace app\config;

use app\config\Settings;

class ErrorLog {


    const LOGFILE_RIGHTS = 644;
    const LOGFILE_NAME = "error.log";

    function getLogString(string $message, $class = '', $row = 0) {
        $error_string =  "[".date("Y-m-d H:i:s")."] ".$message;
        if(!empty($class)) {
            $error_string .= " in ".$class;
        }
        if($row != 0) {
            $error_string .= " in ".$row;
        }

        return $error_string;
    }

    function writeErrorLog(string $message, $class = '', $row = 0) {
        if(self::getFileRights() == self::LOGFILE_RIGHTS) {
            $handler = fopen(Settings::LOG_PATH.self::LOGFILE_NAME,"a+");   
            if($handler != false) {
                if(fwrite($handler,self::getLogString($message,$class,$row))) {
                    fclose($handler);
                    return true;
                }else {
                    return false;
                }
                
            }else {
                return false;
            }
        }else {
            return false;
        }
    }


    function getFileRights() {
        return fileperms(Settings::LOG_PATH.self::LOGFILE_NAME);
    }
}