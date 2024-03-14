<?php

namespace app\models\services;

use app\config\Settings;
use app\models\entity\Screen as EntitiyScreen;
use app\models\Service;
use app\core\SliderConfig;

class ScreenService extends Service {

    function __construct($entityManager) {
        parent::__construct($entityManager);
    }

    function create(string $name, string $mode) {
        if(isset($name) && !empty($name) && isset($mode) && !empty($mode)) {
            $bytes = random_bytes(5);
            $token = bin2hex($bytes);
            $create = new EntitiyScreen($name,$mode, $token);
            self::save($create);
            SliderConfig::createCofigfile($name);
            return true;
        } else {
            return false;
        }
    }

    function edit(array $data, int $id) {
        $screen = self::load('Screen', $id);

        if(isset($data['screen_name']) && $data['screen_name'] != ''){
            $screen->setName($data['screen_name']);
        }else{
            $data['message'] = $this->message->setMessage('error', 'Der Bildschirm muss benannt werden');
        }
        if(isset($data['screen_online']) && $data['screen_online'] != ''){
            $screen->setOnline(1);
        }else{
            $screen->setOnline(0);
        }
        if(isset($data['mode']) && $data['mode'] != ''){
            $screen->setMode($data['mode']);
        }else{
            $data['message'] = $this->message->setMessage('error', 'Der Bildschirm muss in einem Modus betrieben werden');
        }

        $slotsEntry = '';
        if(isset($data['screen'])){
            foreach($data['screen'] as $slots => $packages){
                $packageCount = count($packages);
                $i = 1;
                $slotsEntry.=$slots.':';
                foreach($packages as $key => $packageId){
                    $package = self::load("Package",$packageId);          
                    if($i < $packageCount){
                        $slotsEntry.=$package->getId().',';
                    }else{
                        $slotsEntry.=$package->getId().';';
                    }
                    $i++;
                }
            }
            $screen->setSlots($slotsEntry);
        }else{
            $screen->setSlots('');
        }
        if(self::save($screen)) {
            $data['message'] = $this->message->setMessage('success', 'Ihre Änderungen wurden gespeichert');
        } else {
            $data['message'] = $this->message->setMessage('error', 'Ihre Änderungen konnte leider nicht gespeichert');
        }
        return $data;
    }

    function delete($id) {
        $screenObj = self::load('screen', $id);
        if($screenObj){
            self::removeEntity($screenObj);
            $data['message'] = $this->message->setMessage('success', 'Bildschrim wurde erfolgreich gelöscht');
        }else{
            $data['message'] = $this->message->setMessage('error', 'Bildschrim konnte nicht gelöscht werden');
        }
        return $data;
    }

    function loadByToken($token) {
        
        $screenObj = false;
        $screenObj = self::findBy('\app\models\entity\Screen', array('token' => $token));

        if($screenObj){
            $data['screen'] = $screenObj;
        }else{
            $data['message'] = $this->message->setMessage('error', 'Bildschrim konnte nicht gelöscht werden');
        }
        return $data;
    }



    // function load(int $id) {
    //     return $this->entityManager->find('app\models\entity\Screen', $id);
    // }


}