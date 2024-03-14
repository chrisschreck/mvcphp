<?php


namespace app\core;

use app\config\Settings;


class SliderConfig
{

	static function createCofigfile($name) {
		if(!empty($name)) {
			$file_structure = array("name" => "$name", "last_update" => "", "slider_1" => "", "slider_2" => "", "slider_3" => "", "slider_4" => "");
			file_put_contents(Settings::JSON_CONFIG.trim(strtolower($name).".json"),json_encode($file_structure));
		}
	}
}