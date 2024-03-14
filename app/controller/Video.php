<?php

namespace app\controller;

use app\core\Basecontroller;

class Video extends Basecontroller {

    function index() {
        $this->view->generateTpl("video");
    }

}