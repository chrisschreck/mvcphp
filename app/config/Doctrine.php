<?php
namespace app\config;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
use app\config\Settings;
use Exception;

class Doctrine {

    protected $isDevMode = true;
    protected $proxyDir = null;
    protected $cache = null;
    protected $useSimpleAnnotationReader = false;
    protected $entityManager = null;

    function getEntityManager(): EntityManager
    {
        try {
            $config = ORMSetup::createAnnotationMetadataConfiguration(array(Settings::ENTITY_PATH), $this->isDevMode, $this->proxyDir, $this->cache, $this->useSimpleAnnotationReader);
        
            #database configuration parameters
            $conn = array(
                'dbname' => Settings::DB,
                'user' => Settings::USER,
                'password' => Settings::PASSWORD,
                'host' => Settings::HOST,
                'driver' => 'pdo_mysql',
                'charset'  => 'utf8',
                'driverOptions' => array(
                    1002 => 'SET NAMES utf8'
                )
            );
            
            return EntityManager::create($conn, $config);
        }
        catch (Exception $e) {
            //var_dump($e->getMessage());
            new Exception($e);
        }
            
    }
    
    
}

