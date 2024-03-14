<?php

namespace app\api;


class ApiInstance {

    protected string $name;
    protected string $baseUrl;
    protected array $parameter = [];
    protected string $responseType;
    protected string $returnData;

    function __construct(string $name,string $baseUrl, $params, string $responseType) {
        $this->name = $name;
        $this->baseUrl = $baseUrl;
        $this->parameter = $params;
        $this->responseType = $responseType;
    }


    /**
     * @throws \Exception
     */
    function sendRequest(string $methode)
    {


        if( $this->validateUrl($this->generateUrl()) ) {
            try {
                switch($methode) {
                    case 'HEAD':
                    case 'GET':
                        $returnData = file_get_contents($this->generateUrl());
                        if( $this->checkResponse($returnData, $this->responseType,$http_response_header) ) {
                            return $returnData;
                        }
                    case 'PUT':
                    case 'POST':
                    case 'DELETE':
                        break;
                }

            } catch(Exception $e) {
                throw $e;
            }


        }
    }


    function checkResponse(string $data, string $type, array $headers): bool
    {

        if(http_response_code() == 200 && $headers[2] == "Content-Type: application/".$type."; charset=utf-8") {
            switch($type) {
                case "json":
                    json_decode($data);
                    return (json_last_error() == JSON_ERROR_NONE);
                    break;
                case "xml":
                    echo "XML coming soon";
                    break;
                case "test":
                    echo "test";
                    break;
                default:
                    throw new \Exception(__METHOD__."Response-Type is not supported");
            }
        }
        
    }

    private function generateUrl(): string
    {
        return $this->baseUrl."/".implode("/", $this->parameter);
    }

    private function validateUrl($url): bool
    {
        if(empty($url)) {
            throw new Exception(__METHOD__.'URL not set');
        }

        $urlParts = parse_url($url);
        if(!empty($urlParts["scheme"]) 
            && ($urlParts["scheme"] == "http" || $urlParts["scheme"] == "https")
            && !empty($urlParts["scheme"])
            && !empty($urlParts["path"])) {

                list($status) = get_headers($url);

                if (strpos($status, '404') !== FALSE) {
                    throw new \Exception(__METHOD__." - URL is not reachable");
                } else {
                    return true;
                }
            } else {
                throw new \Exception(__METHOD__." - There are missing some params");
            }
    }

    function setDataFromUrl(string $url) {

    }

    function addParam() {

    }
}