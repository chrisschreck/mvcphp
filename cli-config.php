<?php

require_once 'bootstrapp.php';

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);