<?php

namespace app\models;

use Doctrine\DBAL\Types\ObjectType;
use app\core\Message;
use app\core\CsvImporter;

class Service {

    protected $entityManager;
    protected $message;

    function __construct($entityManager) {
        $this->entityManager = $entityManager;
        $this->message = new Message();
    }

    function save(Object $object) {
        if(isset($object) && !empty($object)) {
            $this->entityManager->persist($object);
            $this->entityManager->flush();
            return true;
        } else {
            return false;
        }
    }

    function load(string $type,int $id) {
        return $this->entityManager->find('app\models\entity\\'.$type, $id);
    }

    function findBy(string $type, Array $criteria) {
        return $this->entityManager->getRepository($type)->findBy($criteria);
    }

    function loadAll(string $type) {
        return $this->entityManager->getRepository('app\models\entity\\'.$type)->findBy([]);;
    }

    function removeEntity($entity) {
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}