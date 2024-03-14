<?php

namespace app\core;

use app\views\BaseView;
use app\config\Settings;
use app\models\services\ScreenService;
use app\models\services\RssService;
use app\config\Doctrine;
use app\models\services\MultimediaService;
use app\models\services\AuthorService;
use app\models\services\PackageService;
use app\core\Message;
use app\core\Slider;
use app\api\CatchData;

class Basecontroller {

    protected $view;
    protected $model;
    protected $screen;
    protected $doctrine;
    protected $rss;
    protected $multimedia;
    protected $weather;
    protected $author;
    protected $package;
    protected $message;
    protected $api;
    // protected $slider;

    function __construct() {
        $this->doctrine = new Doctrine();
        $this->view = new BaseView();
        $this->screen = new ScreenService($this->doctrine->getEntityManager());
        $this->rss = new RssService($this->doctrine->getEntityManager());
        $this->multimedia = new MultimediaService($this->doctrine->getEntityManager());
        $this->author = new AuthorService($this->doctrine->getEntityManager());
        $this->package = new PackageService($this->doctrine->getEntityManager());
        $this->message = new Message();
        $this->api = new CatchData();
    }

    #Checks if an existing Template has been given over
    function tplAvailable(string $tpl) {
        if(file_exists(Settings::TPL_PATH.$tpl)) {
            return true;
        } else {
            return false;
        }
    }

    #Checks if an existing Data-Array has been given over
    function dataNotEmpty(array $data) {
        if(isset($data) && !empty($data)) {
            return true;
        } else {
            return false;
        }
    }

}