<?php

namespace app\config\log;

use app\config\log\LogMessage;
use app\config\Settings;


class LogFile {

    protected $name;
    protected $expiryDate;
    protected $messages = array();

    function __construct(string $name) {
        $this->name = $name;
    }

    function setTest() {
        echo "TESTESTESTETESTETSTEST";
    }

    function getLogFilePath(): string
    {
        return Settings::LOG_PATH.$this->name;
    }

    function addLine(string $message)
    {
        if(!empty($message) && is_string($message))
        {
            file_put_contents($this->getLogFilePath(),$message);
        } else {

        }
    }

    function addMessage(LogMessage $message)
    {
        $this->messages[] = $message;
    }

}