<?php

namespace app\config\proxy;

use app\config\Settings;

class Proxy
{

    protected $proxy_status;
    protected $errno;
    protected $errstr;
    protected $proxy_url;
    protected $proxy_port;
    protected $data;
       const PROXY_CONTEXT_SETTINGS = array(
           'http' => array(
               'proxy' => Settings::PROXY
           ),
       );

    function __construct($url, $port)
    {
        $this->proxy_url = $url;
        $this->proxy_port = $port;
    }

    function urlAvailable(string $host, int $port): bool
    {
//        if($socket =@ fsockopen($host, 80, $this->errno, $this->errstr, 10)) {
//            fclose($socket);
//            return true;
//        } else {
//            return false;
//        }


        $errors = ["HTTP/1.1 401 Unauthorized",'HTTP/1.1 404 Not Found'];
        $header = get_headers($host);
        if(!in_array($header[0], $errors)) {
            return true;
        } else {
            return false;
        }
    }

    function proxyAvailable(string $url, int $port) {
        //var_dump(@get_headers("https://www.xmedias.de"));
        if(dns_get_record($url)) {

            try {
                $fp = fsockopen(Settings::PROXY_PATH,Settings::PROXY_PORT,$errCode,$errStr,Settings::PROXY_TIMEOUT);
                echo 'yes';
                fclose($fp);
            }
            catch(\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
         //var_dump(fsockopen(Settings::PROXY_PATH, Settings::PROXY_PORT, $this->errno, $this->errstr, 10));
    }

    function setProxy() {

    }

    function getErrorString() {
        return $this->errstr;
    }

    function getErrorNum() {
        return $this->errno;
    }

    function setProxyUrl($url) {
        $this->proxy_url = $url;
    }

    function getProxyUrl() {
        return $this->proxy_url;
    }

    function getProxyPort() {
        return $this->proxy_url;
    }

    function setProxyPort($port) {
        $this->proxy_port = $port;
    }

    function fileGetContents(string $link) {
        if(self::proxyAvailable($this->proxy_url,$this->proxy_port) !== false) {
            if(self::urlAvailable($link,80)) {
                $cxContext = stream_context_create(self::PROXY_CONTEXT_SETTINGS);
                $this->data = json_decode(file_get_contents($link, False, $cxContext));

            } else {
                return [false, "Diese Daten sind zur Zeit nicht Verfügbar."];
            }
        } else {

            if(self::urlAvailable($link,80)) {
                //is json?
                $this->data = file_get_contents($link);
                return true;
            } else {
                return [false, "Diese Daten sind zur Zeit nicht Verfügbar."];
            }
        }

    }

}