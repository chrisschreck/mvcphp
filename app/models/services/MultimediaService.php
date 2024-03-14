<?php

namespace app\models\services;

use app\config\Settings;
use app\models\services\UploadSerivice;
use app\core\DateTime;
use app\models\entity\Multimedia;


class MultimediaService extends UploadService {

    function __construct($entityManager) {
        parent::__construct($entityManager);
    }

    function create(array $files, array $post) {
        if(self::upload($files,$post) != false) {
            $data['message'] = $this->message->setMessage('success', 'Multimedia wurde erfolgreich angelegt');
        } else {
            $data['message'] = $this->message->setMessage('error', 'Multimedia konnte leider nicht angelegt werden');
        }
    }

    function edit(array $file, array $data, Multimedia $object) {
        if(is_object($object)) {
            if(!empty($data["multi_startdate"]) && !empty($data["multi_enddate"])) {
                $date1 = DateTime::getFormatDate($data["multi_startdate"]);
                $date2 = DateTime::getFormatDate($data["multi_enddate"]);
                $object->setStartDate($date1);
                $object->setEndDate($date2);
                if(self::save($object)) {
                    $data = $this->message->setMessage('success', 'Multimedia wurde erfolgreich bearbeitet');
                } else {
                    $data = $this->message->setMessage('error', 'Multimedia konnte leider nicht bearbeitet werden');
                }
            } else {
                $data = $this->message->setMessage('error', 'Bei dieser Aktion ist ein Fehler aufgetreten, bitte versuchen sie es erneut');
            }
            
        } else {
            $data = $this->message->setMessage('error', 'Bei dieser Aktion ist ein Fehler aufgetreten, bitte versuchen sie es erneut');
        }
        return $data;
    }

    function delete($id) {
        $multimedia = self::load('Multimedia', intval($id));
        if($multimedia){
            self::removeEntity($multimedia);
            $data['message'] = $this->message->setMessage('success', 'Der RSS-Feed wurde erfolgreich gelöscht');
        }else{
            $data['message'] = $this->message->setMessage('error', 'Der RSS-Feed konnte nicht gelöscht werden');
        }
        return $data;

    }
}