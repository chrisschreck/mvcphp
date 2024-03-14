<?php

namespace app\models\services;

use app\models\Service;
use app\config\Settings;
use app\models\entity\Rss as Feed;
use app\core\DateTime;

class RssService extends Service {

    function __construct($entityManager) {
        parent::__construct($entityManager);
    }

    function create($post) {
        if(isset($post["rss_name"]) && !empty($post["rss_name"]) && isset($post["rss_link"]) && !empty($post["rss_link"]) && isset($post["type"]) && !empty($post["type"])) {
            $feed = new Feed($post["rss_name"],$post["rss_link"],$post["type"]);
            if(is_object($feed)) {
                if(isset($post["rss_startdate"]) && !empty($post["rss_startdate"]) && isset($post["rss_enddate"]) && !empty($post["rss_enddate"])) {
                    $feed->setStartDate(DateTime::getFormatDate($post["rss_startdate"]));
                    $feed->setEndDate(DateTime::getFormatDate($post["rss_enddate"]));
                }
                if(self::save($feed)) {
                    $data = $this->message->setMessage('success', 'Der RSS-Feed wurde erfolgreich angelegt');
                } else {
                    $data = $this->message->setMessage('error', 'Bei anlegen des RSS-feeds ist ein Fehler aufgetreten');
                }
            } else {
                $data = $this->message->setMessage('error', 'Bei anlegen des RSS-feeds ist ein Fehler aufgetreten');
            }
        } else {
            $data = $this->message->setMessage('error', 'Bitte alles ausfüllen');
        }

        return $data;
    }

    function edit(array $post, int $id) {



        if(!empty($post) && !empty($id)) {

            foreach($post as $value ) {
                if($value == '') {
                    $data = $this->message->setMessage('error', 'Es wurden nicht alle Felder ausgefüllt');
                    return $data;
                }
            }

            $rss_object = self::load("Rss",$id);
            if(is_object($rss_object)) {
                $rss_object->setName($post["rss_name"]);
                $rss_object->setLink($post["rss_link"]);
                $rss_object->setType($post["rss_type"]);
                $date1 = DateTime::getFormatDate($post["rss_startdate"]);
                $date2 = DateTime::getFormatDate($post["rss_enddate"]);
                //if(!is_null($date1) && !is_null($date2)) {
                    $rss_object->setStartDate(DateTime::getFormatDate($post["rss_startdate"]));
                    $rss_object->setEndDate(DateTime::getFormatDate($post["rss_enddate"]));
                //}
                if(self::save($rss_object)) {
                    //return $rss_object;
                    $data = $this->message->setMessage('success', 'Der RSS-Feed wurde erfolgreich bearbeitet');
                } else {
                    $data = $this->message->setMessage('error', 'Beim bearbeiteen des RSS-feeds ist ein Fehler aufgetreten');
                }
                return $data;
            }
            
        } else {

        }
    }

    
    function delete($id) {
        $rss = self::load('Rss', intval($id));
        if($rss){
            self::removeEntity($rss);
            $data['message'] = $this->message->setMessage('success', 'Der RSS-Feed wurde erfolgreich gelöscht');
        }else{
            $data['message'] = $this->message->setMessage('error', 'Der RSS-Feed konnte nicht gelöscht werden');
        }
        return $data;
        
    }

}