<?php


namespace app\config;

use \app\core\Autoload;
use app\config\Settings;
use app\config\ExceptionHandler;

class App
{

	protected $mode="DEV"; # DEV OR PROD
	protected $proxy_url = "";
	protected $autoload = true;

	function __construct()
	{

	}

	function showArray(array $array) {
		echo "<pre>";
		var_dump($array);
		echo "</pre>";
	}

	function setProjektProxy() {

	}

	function showErrors() {
		# Fehlersichtbatkeit php
		#error_reporting(-1);
		#ini_set("display_errors", 1);
		#--> Anpassen je nach Mode
	}

	function setAutoloader() {
		if($this->autoload === true) {
			Autoload::register();
		}
	}
}