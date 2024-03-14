<?php

namespace app\config;

class Settings {

    #General
    const DIRECTORY_SEPARATOR = "/";
    const URL_PROTOCOL = "http";
    const MODE = "DEBUG"; #DEBUG OR PROD

    #Database Informations
    const DB = "mvc";
    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "Mannheim1998??";

    #Doctrine
    const ISDEVMODE = true;
    const PROXYDIR = null;
    const CACHE = null;
    const USERSIMPLEANNOTATIONRAEDER = false;
    const ENTITYMANAGER = null;
    const DRIVER = "pdo_mysql";
    const CHARSET = "utf8";

    #Proxy
    const PROXY = '';
    const PROXY_PATH = "";
    const PROXY_PORT = 3128;
    const PROXY_TIMEOUT = 5;

    #API
    const API_TIME_OUT = 10;

    #Directory Paths

    const URL_PRE = URL_PROTOCOL.'://mvc.localhost/';
    const ABS_PATH = DIRECTORY_SEPARATOR.'Users'.DIRECTORY_SEPARATOR.'cschreck'.DIRECTORY_SEPARATOR.'webprojects'.DIRECTORY_SEPARATOR.'git_projects'.DIRECTORY_SEPARATOR.'mymvc'.DIRECTORY_SEPARATOR;
    const TPL_PATH = self::ABS_PATH.'app'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR;
    const CONTR_PATH = self::ABS_PATH.'app'.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR;
    const ENTITY_PATH = self::ABS_PATH.'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.'Entity'.DIRECTORY_SEPARATOR;
    const LOG_PATH = self::ABS_PATH.'logs'.DIRECTORY_SEPARATOR;
    const UPLOAD_PATH = self::ABS_PATH.'htdocs'.DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;
    const JSON_CONFIG = self::ABS_PATH.'slider_settings'.DIRECTORY_SEPARATOR;

    #Logging
    const SYSTEM_ERRORS = self::ABS_PATH.'logs'.DIRECTORY_SEPARATOR.'system_log.log';
    const USER_ERRORS = self::ABS_PATH.'logs'.DIRECTORY_SEPARATOR.'user_log.log';

    #Layout Paths
    const CSS_PATH = DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR;
    const JS_PATH = DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR;
    const IMG_PATH = DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'media/img'.DIRECTORY_SEPARATOR;
    const ICON_PATH = DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'media/icons'.DIRECTORY_SEPARATOR;
    const UPLOAD_PIC_PATH = DIRECTORY_SEPARATOR.'layout'.DIRECTORY_SEPARATOR.'media/upload'.DIRECTORY_SEPARATOR;

    #Sonstiges
    const DEFAULT_TPL = 'start';
    const DEFAULT_CON = 'start';
    const DEFAULT_ACTION = 'start';
    const SCREEN_MODE_TYPES = ["four_divided","one_screen"];
    const UPLOAD_URI_PATH = '';


    public static function is_debug()
    {
        return self::MODE == "DEBUG";
    }

}