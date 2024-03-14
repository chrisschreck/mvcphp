<?php

namespace app\core;

use app\config\Settings;


class Database {

    protected $db = NULL;
    private static $datenbank = NULL;

    #----- DB - VERBINDUNG ------
    function __construct() {
        if (is_null(self::$datenbank)) {
            try {
                self::$datenbank = new \PDO('mysql:dbname='.Settings::DB.';host='.Settings::HOST, Settings::USER, Settings::PASSWORD); 
            } catch (\PDOException $e) {
                //Error Log
            }
        }
        $this->db = self::$datenbank;
        return $this->db;
    }


    #----- MYSQL QUERY ------
    public function query(string $query) {
        if ($query != "") {
            $stmt = $this->db->prepare($query);
            if ($result = $stmt->execute() === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
            //Error Log
        }
    }

    #----- MYSQL SELECT ------
    public function select(string $query, $fetch) {
        if ($query != "" && isset($fetch) && $fetch != "") {
            $stmt = $this->db->prepare($query);
            $result = $stmt->execute();
            if ($stmt->rowCount() > 0) {
                if ($result === true) {
                    return $stmt->fetchAll($fetch);
                } else {
                    return false;
                }
            }
        } else {
            //ExceptionHandler::logException(ExceptionHandler::createLogString("'select'-function in Model.php"));
            return false;
        }
    }

    #----- MYSQL INSERT ------
    function insert(string $table, array $data) {
        
    }

    #----- MYSQL UPDATE ------
    function update() {
        
    }

    function insertObject($object) {
        var_dump($object);
    }
}

