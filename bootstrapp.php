<?php

require_once "app/config/Settings.php";
require_once "app/config/Doctrine.php";

use app\config\Settings;
use app\config\Doctrine;

$doctrine = new Doctrine();
$entityManager = $doctrine->getEntityManager();
