<?php

namespace app\core;

require_once "vendor/autoload.php";

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use app\config\Settings;

class EntityHandler {

    protected $entityManager;

    function __construct() {

        $isDevMode = true;
        $proxyDir = null;
        $cache = null;
        $useSimpleAnnotationReader = false;

        $config = ORMSetup::createAnnotationMetadataConfiguration(array(Settings::ENTITY_PATH), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);

        #database configuration parameters
        $conn = array(
            'dbname' => Settings::DB,
            'user' => Settings::USER,
            'password' => Settings::PASSWORD,
            'host' => Settings::HOST,
            'driver' => 'pdo_mysql',
        );

        $this->entityManager = EntityManager::create($conn, $config);
    }
}