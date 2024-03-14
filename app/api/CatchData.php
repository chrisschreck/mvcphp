<?php 

namespace app\api;

use app\api\ApiInstance;

class CatchData {

    function getApiToken() {    

    }

    function fetchData(string $name, string $baseUrl, $params, string $responseType) {
        if(isset($name) && !empty($name) &&
        isset($baseUrl) && !empty($baseUrl) &&
        isset($responseType) && !empty($responseType)) {
            $instance = new ApiInstance($name, $baseUrl, $params, $responseType);
            try {
                return $instance->sendRequest("GET");
            } catch (Exception $e) {
                throw $e;
            }
        } else {
            #ERROR
        }
        
    }
}