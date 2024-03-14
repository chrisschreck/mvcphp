<?php

namespace app\controller;

use app\core\Basecontroller;

class Rss extends Basecontroller {

    const PAGE = "Rss";

    function index() {

        $data["rss"] = $this->rss->loadAll("Rss");
        var_dump($_POST);
        if(isset($_POST["delete-rss"])) {
            $this->rss->delete($_POST["delete-rss"]);
        }
        $this->view->generateTpl("rss_home",self::PAGE,$data);
    }

    function new() {
        if(isset($_POST["rss_submit"])) {
            $data["message"] = $this->rss->create($_POST);
            $this->view->generateTpl("rss_new",self::PAGE,$data);
        } else {
            $this->view->generateTpl("rss_new",self::PAGE);
        } 
    }

    function edit(int $id) {
        if(!empty($id)) {
            $data["edit_dataset"] = $this->rss->load(self::PAGE,$id);
            if(isset($_POST["submit_rss"])) {
                $data["message"] = $this->rss->edit($_POST,$id);
            }
            $this->view->generateTpl("rss_edit",self::PAGE,$data);
        } else {
            $this->view->generateTpl("rss_edit",self::PAGE);
        }

        
    }
}