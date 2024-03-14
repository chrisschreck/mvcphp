<?php 

/*
 * Helper Class
 * @author Christopher Schreck <cschreck@xmedias.de>
*/

namespace app\core;
use \DateTime as Date;

class DateTime {

    public static $date;
    public static $returndate;

    function __construct($name) {
        $this->name = $name;
    }

    public static function getFormatDate($date) {
        if(!empty($date)) {
            return self::getDate($date);
        } else {
            return NULL;
        }
    }

    private static function getDate($date) {
        $test = new Date($date);
        return $test;
    }
}