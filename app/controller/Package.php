<?php

namespace app\controller;

use app\config\Settings;
use app\core\Basecontroller;

class Package extends Basecontroller {

    const PAGE = "Package";

    function index() {

        if(isset($_POST['delete-package'])){
            $data = $this->package->delete($_POST['delete-package']);
        }

        $data["packages"] = $this->package->loadAll("Package");
        $this->view->generateTpl("package", self::PAGE,$data);
    }

    function new() {
        if(isset($_POST["submit_package"])) {
            $data = $this->package->create($_POST);
            //$this->view->generateTpl("package_new", self::PAGE, $data);
        }

        $data["authors"] = $this->author->loadAll('Author');
        $data["pictures"] = $this->multimedia->loadAll("Multimedia");   
        $data["rss"] = $this->rss->loadAll("Rss");
        $this->view->generateTpl("package_new", self::PAGE, $data);
    }

    function edit(int $id = 0) {
        if($id != 0) {
            $data["edit_package"] = $this->package->load(self::PAGE, $id);
        }

        if(isset($_POST["submit_package"])) {
            if($id != 0) {
                $data["message"] = $this->package->update($_POST,$id);
            }
        }
        
        #$data["authors"] = $this->author->getAuthors($this->author->getAuthorLink());
        $data["authors"] = $this->author->loadAll('Author');
        $data["pictures"] = $this->multimedia->loadAll("Multimedia");   
        $data["rss"] = $this->rss->loadAll("Rss");
        //var_dump($data);
        $this->view->generateTpl("package_edit", self::PAGE, $data);
    }
}

