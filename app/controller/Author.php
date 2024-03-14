<?php 

namespace app\controller;

use app\core\Basecontroller;
use app\core\App;

class Author extends Basecontroller {   


    const PAGE = "Author";
    /* 
    * inital call function
    */
    function index() {
        $data['picPath'] = \app\config\Settings::UPLOAD_URI_PATH;
        //$data["authors"] = $this->author->getAuthors($this->author->getAuthorLink());
        if(isset($_POST['delete-file'])){
            $data = $this->author->delete($_POST['delete-file']);
        }
        $data["authors"] = $this->author->loadAll('Author');
        $this->view->generateTpl("author",self::PAGE, $data);
    }

    /* 
    * create author function
    */
    function new() {
        if(isset($_POST["author_submit"])) {
            $data = $this->author->create($_POST, $_FILES);
            $this->view->generateTpl("author_new",self::PAGE, $data);
        }
        $this->view->generateTpl("author_new",self::PAGE);  
    }

    /*
    * import a csv file with author data
    */
    function import() {
        if(isset($_POST["author_submit"])) {   
            if(isset($_FILES['author_csv']['size']) && ($_FILES['author_csv']['size'] > 0)){
                $data = $this->author->import($_FILES['author_csv']);
            }else{
                $data['message'] = $this->message->setMessage('error', 'Es wurde keine CSV Datei ausgewählt');
            }
      
            $this->view->generateTpl("author_import", self::PAGE, $data);  
        }
        $this->view->generateTpl("author_import",self::PAGE);  
    }
    /* 
    * modify author object function
    */
    function edit(int $id = 0) {     
        $data['picPath'] = \app\config\Settings::UPLOAD_URI_PATH;
        if(isset($_POST["author_edit_submit"])) {
            $data['author'] = $this->author->edit($_POST, $_FILES, $id);     
                if($data['author']){
                    $data['message'] = $this->message->setMessage('success', 'Autor wurde erfolgreich editiert');
                }
        } else {
            $data['author'] = $this->author->load('author', $id);
        }
        if(!$data['author']) {
            $data['message'] = $this->message->setMessage('error', 'Es konnte kein Autor gefunden werden');
            $data['error'] = true;
            $this->view->generateTpl("author_edit", self::PAGE,$data);  
        }
        $this->view->generateTpl("author_edit", self::PAGE,$data);  
    }
}