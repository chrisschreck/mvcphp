<?php

namespace app\config\log;

use app\config\Settings;

class LogMessage {

    protected $logCode;
    protected $message;
    protected $file;
    protected $line;

    const LOG_TYPE = array(0 => "EXCEPTION", 1 => "ERROR", 2 => "USER_ERRORS");

    function __construct(int $logCode, string $message, string $file, int $line) {
        $this->logCode = $logCode;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }

    function getLogType(): string
    {
        return self::LOG_TYPE[$this->logCode];
    }

    function createMessage(): string
    {
    	return "[".date('Y/m/d H:i:s')."] ".$this->getLogType().": ".$this->message." in ".$this->file." in Line ".$this->line();
    }

}