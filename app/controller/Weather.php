<?php

namespace app\controller;

use app\core\Basecontroller;


class Weather extends Basecontroller 
{

    function index() {

        $data["weather"] = $this->weather->loadAll("Weather");
        $this->view->generateTpl("weather_home",$data);
    }

    function new() {
        if(isset($_POST["new-weather"])) {
            $this->weather->create($_POST["town"],$_POST["rss-path"]);
        }

        $this->view->generateTpl("weather_new");
    }

}