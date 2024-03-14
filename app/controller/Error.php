<?php


namespace app\controller;

use app\core\Basecontroller;
use app\config\Settings;


class Error extends Basecontroller
{

    const PAGE = "Error";

    function index() {
        $this->view->generateTpl("error",self::PAGE);
    }
}