<?php

namespace app\core;

use app\config\Settings;

class App {

    private $contrName = 'Home';
    private $method = 'index';
    private $controller = NULL;
    private $parameter = [];
    private $url;
    private $contrPara = 1;
    private $methodPara = 2;
    private $para = 3;

    function __construct() {
        $this->url = $this->getUrl();
        if (isset($this->url[$this->contrPara])) {                                                                                      #Controller zuweisung
            if (file_exists(Settings::CONTR_PATH . mb_convert_case($this->url[$this->contrPara], MB_CASE_TITLE, "UTF-8") . ".php")) {
                $this->contrName = mb_convert_case(mb_strtolower($this->url[$this->contrPara]), MB_CASE_TITLE, "UTF-8");
            }
        }
        $contr = '\app\\controller\\' . $this->contrName;                                                                          #Zusammenbau Namespace und aktueller Controller
        require_once(Settings::CONTR_PATH . $this->contrName . ".php");                                                                 #Einbinden des Controllers
        $this->controller = new $contr();

        if (isset($this->url[$this->methodPara])) {                                                                                     #Model zuweisung
            if (method_exists($this->controller, $this->url[$this->methodPara])) {
                $this->method = $this->url[$this->methodPara];
            }
        }

        if (count($this->url) > 3) {
            $this->parameter = array_slice($this->url, 3);
        } else {
            if (isset($url[$this->para])) {
                $this->parameter[] = $url[$this->url[$this->para]];
            }
        }

        call_user_func_array([$this->controller, $this->method], $this->parameter);
    }

    #return the current url
    static function getUrl($uriLevel = false) {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = explode("/", trim($_SERVER['REQUEST_URI']));

            if($uriLevel){
                if(isset($url[$uriLevel])){
                    return $url[$uriLevel];
                }else{
                    if(isset($url[($uriLevel-1)])){
                        return $url[($uriLevel-1)];
                    }
                }
            }

            return $url;
        }
    }
}