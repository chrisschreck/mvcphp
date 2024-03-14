<?php

namespace app\models\services;

use app\models\entity\Package;
use app\models\Service;
use \DateTime;
use Doctrine\DBAL\Types\ObjectType;
use Doctrine\ORM\Query\ResultSetMapping;

class PackageService extends Service {

    #for updating a package, so you can setPackage and after that you 
    private $package_id;

    const MEDIA_TYPES = ["multimedia","author", "rss"];

    public function create($post) {
        if(isset($post["name"])) {
            $new = new Package($post["name"]);
            if(is_object($new)) {
                self::addMedia($post,$new);
            
                if(self::save($new) == true) {
                    $data['message'] = $this->message->setMessage('success', 'Package wurde erfolgreich angelegt');
                } else {
                    $data['message'] = $this->message->setMessage('error', 'Package konnte leider nicht anlegt werden');
                }
            } else {
                $data['message'] = $this->message->setMessage('error', 'Package konnte leider nicht anlegt werden');
            }
            return $data;
        }
    }

    function update($data, int $id) {
        if(isset($data["name"])) {
            $update = self::load('Package',$id);
            $update->setName($data["name"]);
            self::addMedia($data,$update);
            self::removeMedia($data,$update);
            if(self::save($update)) {
                $data = $this->message->setMessage('success', 'Package wurde erfolgreich bearbeitet');
            } else {
                $data = $this->message->setMessage('error', 'Package konnte leider nicht bearbeitet werden');
            }
        } else {
            $data = $this->message->setMessage('error', 'Bitte füllen Sie alles aus');
        }
        return $data;
    }

    private function addMedia($data, Package $object) {
        if(isset($data["multimedia"])) {
            foreach($data["multimedia"] as $id => $value) {
                $pic = "";
                $pic = self::load("Multimedia",$id);
                if(!is_null($object->getMultimediaIds())) {
                    if(!in_array($id,$object->getMultimediaIds())) {
                        $object->addMultimedia($pic->getId(),$pic);
                    }
                } else {
                    $object->addMultimedia($pic->getId(),$pic);
                }
            }
        }
        if(isset($data["authors"])) {
            foreach($data["authors"] as $id => $value) {
                $author = "";
                $author = self::load("Author",$id);
                if(!is_null($object->getAuthorIds())) {
                    if(!in_array($id,$object->getAuthorIds())) {
                        $object->addAuthor($author->getId(),$author);
                    }
                } else {
                    $object->addAuthor($author->getId(),$author);
                }
                
            }
        }
        if(isset($data["rss"])) {
            foreach($data["rss"] as $id => $value) {
                $rss = "";
                $rss = self::load("Rss",$id);
                if(!is_null($object->getRssIds())) {
                    if(!in_array($id,$object->getRssIds())) {
                        $object->addRss($rss->getId(),$rss);
                    }
                } else {
                    $object->addRss($rss->getId(),$rss);
                }
                
            }
        }
    }

    function removeMedia(array $post, Package $object) {
        if(isset($post["authors"])) {
            $delete = array_diff($object->getAuthorIds(),array_keys($post["authors"]));
            if(!empty($delete)) {
                foreach($delete as $id => $value) {
                    $rss = "";
                    $rss = self::load("Author",$value);
                    $object->removeAuthor($rss);
                }
            }

        } else {
            foreach($object->getAuthorIds() as $id => $value) {
                $rss = "";
                $rss = self::load("Author",$value);
                $object->removeAuthor($rss);
            }
        }

        if(isset($post["multimedia"])) {
            $delete = array_diff($object->getMultimediaIds(),array_keys($post["multimedia"]));
            if(!empty($delete)) {
                foreach($delete as $id => $value) {
                    $rss = "";
                    $rss = self::load("Multimedia",$value);
                    $object->removeMultimedia($rss);
                }
            }
        } else {
            foreach($object->getMultimediaIds() as $id => $value) {
                $rss = "";
                $rss = self::load("Multimedia",$value);
                $object->removeMultimedia($rss);
            }
        }

        if(isset($post["rss"])) {
            $delete = array_diff($object->getRssIds(),array_keys($post["rss"]));
            if(!empty($delete)) {
                foreach($delete as $id => $value) {
                    $rss = "";
                    $rss = self::load("Rss",$value);
                    $object->removeRss($rss);
                }
            }
        } else {
            foreach($object->getRssIds() as $id => $value) {
                $rss = "";
                $rss = self::load("Rss",$value);
                $object->removeRss($rss);
            }
        }
    }

    function setPackage($package_id) {
        $this->package_id = $package_id;
    }

    function delete($id) {

        $packageObj = self::load('package', $id);
        if($packageObj){
            self::removeEntity($packageObj);
            $data['message'] = $this->message->setMessage('success', 'Package wurde erfolgreich gelöscht');
        }else{
            $data['message'] = $this->message->setMessage('error', 'Package konnte nicht gelöscht werden');
        }
        return $data;
    }

    function getAllIds($objects) {
        $ids = [];
        foreach($objects as $object) {
            $ids[] = $objects->getId();
        }
        return $ids;
    }
}





// self::save($new);
// $pic = self::load("Picture",25);
// $section = self::load("Section",1);
// $section->addPicture("test",$pic);
// self::save($section);