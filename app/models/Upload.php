<?php

namespace app\models;

use app\config\Settings;

class Upload {
    
    protected $name;

    protected $type;

    protected $tmp_path;

    protected $error;

    protected $filesize;

    const ERROR_MESSAGE = array (
        array("UPLOAD_ERR_OK" => array("user_response" => "Ihr Upload war erfolgreich.", "system_response" => "Der Upload war erfolgreich.")),
        array("UPLOAD_ERR_INI_SIZE" => array("user_response" => "Das hochgeladene File überschreitet die maximale Größe.", "system_response" => "Die hochgeladene Datei überschreitet die in der Anweisung upload_max_filesize in php.ini festgelegte Größe.")),
        array("UPLOAD_ERR_FORM_SIZE" => array("user_response" => "Das hochgeladene File überschreitet die maximale Größe.", "system_response" => "Die hochgeladene Datei überschreitet die in dem HTML Formular mittels der Anweisung MAX_FILE_SIZE angegebene maximale Dateigröße.")),
        array("UPLOAD_ERR_PARTIAL" => array("user_response" => "Die Datei wurde nur teilweise hochgeladen.", "system_response" => "Die Datei wurde nur teilweise hochgeladen.")),
        array("UPLOAD_ERR_NO_FILE" => array("user_response" => "Es wurde keine Datei hochgeladen.", "system_response" => "Es wurde keine Datei hochgeladen.")),
        array("UPLOAD_ERR_NO_TMP_DIR" => array("user_response" => "Es ist ein Interner Fehler aufgetreten","system_response" => "Fehlender temporärer Ordner.")),
        array("UPLOAD_ERR_CANT_WRITE" => array("user_response" => "Das Speichern der Datei ist fehlgeschlagen","system_response" => "Speichern der Datei auf die Festplatte ist fehlgeschlagen.")),
        array("UPLOAD_ERR_EXTENSION" => array("user_response" => "Es ist ein Interner Fehler aufgetreten","system_response" => "Eine PHP Erweiterung hat den Upload der Datei gestoppt.")),
    );


    function __construct(string $name, string $type, string $tmp_name, int $error, int $size)
    {
        $this->name = $name;
        $this->type = $type;
        $this->tmp_path = $tmp_name;
        $this->error = $error;
        $this->size = $size;
    }

    function checkError() {

    } 
    
    function moveUploadedFile() {
        //Abfragen wegen ERROR und so noch
        if($this->error == 0) {
            move_uploaded_file($this->tmp_path,self::getUploadPath($this->name));
            return true;
        } else {
            return self::ERROR_MESSAGE[$this->error];
        }
    }

    function getUploadPath(string $file) {
        return Settings::UPLOAD_PATH.$file;
    }
}