<?php

namespace app\controller;

use app\config\Settings;
use app\core\Basecontroller;

class Multimedia extends Basecontroller {

    const PAGE = "Multimedia";

    function index() {
        $data["multimedia"] = $this->multimedia->loadAll("Multimedia");
        var_dump($_POST);
        if(isset($_POST["delete-multi"])) {
            $this->multimedia->delete($_POST["delete-multi"]);
        }
        $this->view->generateTpl("multimedia_home",self::PAGE,$data);
    }

    function new() {
        if(isset($_POST["submit-newpic"])) {
            $data["message"] = $this->multimedia->upload($_FILES,$_POST);
            $this->view->generateTpl("multimedia_new",self::PAGE,$data);
        }
       
        $this->view->generateTpl("multimedia_new",self::PAGE);
    }

    function edit(int $id) {
        
        if(isset($id)) {            
            $data["dataset"] = $this->multimedia->load(self::PAGE,$id);
        }

        if(isset($_POST["submit"])) {
            $data["message"] = $this->multimedia->edit($_FILES,$_POST,$this->multimedia->load("Multimedia",$id));
            $this->view->generateTpl("multimedia_edit",self::PAGE,$data);
        }
        $this->view->generateTpl("multimedia_edit",self::PAGE, $data);
    }
}