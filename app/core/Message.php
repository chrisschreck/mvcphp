<?php

namespace app\core;

class Message {

    function __construct(){

    }

    function setMessage(string $type, string $text){
        switch(strtolower($type)){
            case 'error': $class = 'error'; break;
            case 'success': $class = 'success'; break;
            case 'info': $class = 'info'; break;
            case 'default': $class = 'info';break;
        }
        return '<div class="message-container"><p class="message '.$class.'">'.htmlspecialchars($text).'.</p><hr></div>';      
    }

}
