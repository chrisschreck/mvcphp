<?php

namespace app\controller;


use app\core\Basecontroller;
use app\config\Settings;
use app\config\errorhandling\Notification;


class Home extends Basecontroller {

    const PAGE = "Home";

    function index() {
        //throw new \Exception("TEST EXCEPTION"); # Test for ExceptionHandler
        //var_dump($GLOBALS["logFile"]->setTest());
        //https://www.w3schools.com/xml/simple.xml
        #Test für api-Modul /app/api
        //var_dump($this->api->fetchData("Test","http://validate.jsontest.com/?json=%7B%22key%22:%22value%22", array("todos", 6),"json"));exit;
        $data["all_screens"] = $this->screen->loadAll("Screen");
        $this->view->generateTpl("home", self::PAGE,$data);
    }

    function new() {
        if(isset($_POST["submit_new"])) {
            $test = $this->screen->create($_POST["screen_name"], $_POST["mode"]);
        }

        $this->view->generateTpl("screen_new",self::PAGE);
    }

    function edit(int $id = 0) {
        $data["packages"] = $this->screen->loadAll("Package");
        $data["screen"] = $this->screen->load("Screen",$id);
        $this->view->generateTpl("screen_edit",self::PAGE,$data);
    }
}