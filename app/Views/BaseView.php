<?php

namespace app\views;

use app\config\Settings;
use app\core\Datasystem;

class BaseView {

    const PART1 = "header";
    const PART2 = "footer";

    function generateTpl(string $template, string $page, $data = [], $screenMode = false) {
        
        if(!empty($data)) {
            extract($data);
        }

        if($screenMode){
            require_once Settings::TPL_PATH . 'Screen' ."/screen_header.tpl";
        }else{
            self::searchParts(self::PART1);
        }
        if (file_exists(Settings::TPL_PATH . strtolower($page) ."/". strtolower($template).".tpl")) {
            require_once Settings::TPL_PATH . strtolower($page) ."/". strtolower($template).".tpl";
        }
        if($screenMode){
            require_once Settings::TPL_PATH . 'Screen' ."/screen_footer.tpl";
        }else{
            self::searchParts(self::PART2);
        }
        
    }

    public static function restitution(string $style, string $varAusgabe) {
        echo '  <div class="row slide-top">
                    <div class="medium-12 column">
                        <div class="' . $style . '">
                            ' . $varAusgabe . '
                        </div>
                    </div>
                </div>';
    }

    #Search for e.g. Header or Footer, if the file exists
    private static function searchParts(string $type) {  
        if(isset($type)) {
            $files = Datasystem::getDirectoryFiles(Settings::TPL_PATH);             #type = header | footer  --> Funtion nur fuer TPLs
            $grep = preg_grep("/" . $type . ".tpl/", $files);                       #dynamisch machen --> auch fuer Footer und womoeglich andere Files
            switch (count($grep)) {                                                 #count how many TPLs
                case 0:
                    throw new \Exception('Keine '.$type.' vorhanden.');
                    break;
                case 1:
                    require_once Settings::TPL_PATH . $type . '.tpl';
                    break;
                case (count($grep) > 1):
                    throw new \Exception('Mehr als ein '.$type);
                    break;
            }
        }                       
    }
}