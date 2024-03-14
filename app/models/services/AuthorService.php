<?php

namespace app\models\services;

use app\config\proxy\Proxy;
use app\config\Settings;
use app\models\Service;
use app\models\entity\Author;
use app\models\services\UploadService;

class AuthorService extends Service {

    const AUTHOR_API_LINK = "https://www.morgenweb.de/redFACT/REST/backend/module/c-author/list?elem[]=id&elem[]=name&elem[]=image&elem[]=first_name&elem[]=last_name&elem[]=newspaper&elem[]=employment&elem[]=assignment";
    const AUTHOR_API_PREFIX = "https://www.morgenweb.de/redFACT/REST/backend/module/c-author/list?";
    
    protected  $AUTHOR_DATA = array('id', 'name', 'moddate', 'lastchgdate', 'image', 'first_name', 'last_name', 'email', 'newspaper', 'employment', 'assignment', 'makes_pictures', 'makes_videos');
    private $uploadService;

    function __construct($entityManager) {
        parent::__construct($entityManager);
        $this->uploadService = new UploadService($entityManager);
    }


    /* deleting an author */
    function delete($id) {
        $authorObj = self::load('author', $id);
        if($authorObj){
            self::removeEntity($authorObj);
            $data['message'] = $this->message->setMessage('success', 'Autor wurde erfolgreich gelöscht');
        }else{
            $data['message'] = $this->message->setMessage('error', 'Autor konnte nicht gelöscht werden');
        }
        return $data;
        
    }

    /* manual author creation and editing */
    function edit($postData, $image, $id) {
        foreach($postData as $value ) {
            if($value == '') {
                $data['message'] = $this->message->setMessage('error', 'Es wurden nicht alle Felder ausgefüllt');
                return $data;
            }
        }
        $author = self::load('author', $id);
        if(is_object($author)) {
            if($image['author_image']['size'] == 0) {
                $imagePath = $author->getPicPath();
            } else {
                $result = $this->uploadService->uploadAuthorImage($image['author_image']);
                if($result[0]) {
                    $imagePath = $result[1];
                }
            }
            $author->setName($postData['author_firstname']);
            $author->setLastname($postData['author_name']);
            $author->setRessort($postData['author_ressort']);
            $author->setNewspaper($postData['author_newspaper']);
            $author->setEmail($postData['author_email']);
            $author->setPicPath($imagePath);
            self::save($author);
            return $author;
        }
    }

   /* manual author creation and editing */
    function create($postData, $image) {
        // check if something is empty of the required fields
        foreach($postData as $value ) {
            if($value == '') {
                $data['message'] = $this->message->setMessage('error', 'Es wurden nicht alle Felder ausgefüllt');
                return $data;
            }
        }
        /* email in use? */
        if(!$this->isEmailUsed($postData["author_email"])){
            $data['message'] = $this->message->setMessage('error', 'Es wurde bereits ein Autor mit dieser E-Mail Adresse angelegt');
            return $data;
        }
        $result = $this->uploadService->uploadAuthorImage($image['author_image']);
        if(!$result[0]) {
            $data['message'] = $this->message->setMessage('error', $result[1]);
            return $data;
        }
        $author = new Author(
                $postData["author_firstname"],
                $postData["author_name"],
                $postData["author_ressort"],
                $postData["author_email"],
                $postData["author_newspaper"],
                $result[1]
        );
        if(is_object($author)) {
            self::save($author);
            $data['message'] = $this->message->setMessage('success', 'Autor wurde erfolgreich gespeichert');
        } else {
            $data['message'] = $this->message->setMessage('error', 'Autor konnte nicht gepseichert werden');
        }
        return $data;
    }


    function import($file){
        if($file['type'] != 'text/csv'){
            $data['message'] = $this->message->setMessage('error', 'Es wurde eine unzulässige Datei hochgeladen');
            return $data;
        }

        $csvImporter = new \app\core\CsvImporter($file['tmp_name'], true, ';');
        $data = $csvImporter->get();

        /* email in use? */
        foreach($data as $key => $authorData){
            $error = false;
            if(!$this->isEmailUsed($authorData["email"])){
                $data['message'][$key] = $this->message->setMessage('error', 'Es wurde bereits ein Autor mit dieser E-Mail Adresse angelegt: '.$authorData["email"]);
                $error = true;
            }

            $author = new Author(
                    $authorData["first_name"],
                    $authorData["last_name"],
                    $authorData["ressort"],
                    $authorData["email"],
                    $authorData["newspaper"],
                    '');

            if(is_object($author) && $error == false) {
                self::save($author);
                $data['message'][$key] = $this->message->setMessage('success', 'Autor wurde erfolgreich gespeichert');
            } else {
                if(!isset($data['message'][$key])){
                    $data['message'][$key] = $this->message->setMessage('error', 'Autor konnte nicht gespeichert werden: '.$authorData["email"]);
                }
            }
        }
        return $data;
    }

    function isEmailUsed($email){
        if(empty($this->findBy('\app\models\entity\Author', array('email' => $email)))){
            return true;
        }else{
            return false;
        }
    }












    function getAuthors() {}




    function getAuthorsByAuthorDb(string $link) {
        $proxy = new Proxy(Settings::PROXY_PATH, Settings::PROXY_PORT);
        return $proxy->fileGetContents($link);
        //return $proxy->fileGetContents(self::getAuthorLink());
//        $context = array(
//            'http' => array(
//              'proxy' => Settings::PROXY
//            ),
//        );
//        $cxContext = stream_context_create($context);
//        //$authors = json_decode(file_get_contents($link, False, $cxContext));
//        $authors = json_decode(file_get_contents($link));
//        if($authors) {
//            return $authors;
//        } else {
//            return false;
//        }
    }
    function getAuthorLink() {
        $authorlink = "";
        $lastElement = end($this->AUTHOR_DATA);
        foreach($this->AUTHOR_DATA as $value) {
            $authorlink .= "elem[]=".$value;
            if($value != $lastElement) {
                $authorlink .= "&";
            }
        }
        return self::AUTHOR_API_PREFIX.$authorlink;
    }
}