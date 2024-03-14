<?php

namespace app\core;
use \getID3;
/*
* @todo: Static class, unnecessary object
*/
class Slider {

    static function substrwords($text, $maxchar, $end='...') {
        if (strlen($text) > $maxchar || $text == '') {
            $words = preg_split('/\.\s/', $text);      
            $output = '';
            $i      = 0;
            while (1) {
                $length = strlen($output)+strlen($words[$i]);
                if ($length > $maxchar) {
                    break;
                } 
                else {
                    if($i == 0){
                        $output .= $words[$i];
                    }else{
                        $output .= ". " . $words[$i];
                    }
                    ++$i;
                }
            }
            $output .= $end;
        } 
        else {
            $output = $text;
        }
        return $output;
    }

    public static function buildSlider($data){

        $getID3 = new getID3();

        $slider = array('slot-0', 'slot-1', 'slot-2', 'slot-3');

        $weatherdate = array(
            'today' => date("Y-m-d"),
            'tomorrow' => date("Y-m-d", strtotime("+1 day")),
            'tomorrow1' => date("Y-m-d", strtotime("+2 day")),
            'tomorrow2' => date("Y-m-d", strtotime("+3 day")),
            'tomorrow3' => date("Y-m-d", strtotime("+4 day"))
        );
        
        foreach($data as $slot => $ressource){         
            @$slider[$slot].='  
                      <!-- Slideshow container -->
                      <div class="slideshow-'.$slot.'-container" data-duration="9000">';
            foreach($ressource as $type => $objectArray){
                switch($type){
                    case 'authors': // Authors template
                        if(is_array($objectArray)){
                            foreach($objectArray as $key => $object){     
                                $slider[$slot].='
                                <div class="'.$slot.'-slider '.$slot.'-slide fade authors">
                                    <img src="/layout/media/upload/'.$object->getPicPath().'" style="width:100%">
                                </div>';
                            }
                        }
                    break;
                    case 'rss': // RSS template => News and weather
                        if(is_array($objectArray)){
                            $slider[$slot].= '<h2>Newsticker des Mannheimer Morgen</h2><hr>';
                            foreach($objectArray as $key => $object){    
                                if(strtotime($object->getStartDate()) < time() && strtotime($object->getEndDate()) > time()){
                                    
                                    if(substr($object->getType(), 0, 5) == 'news'){
                                        //$slider[$slot].= '<h3>'.$object->getName().'</h3>';
                                        $xml = simplexml_load_file ($object->getLink());
                                        if($xml){
                                            foreach($xml->channel->item as $xmlKeys => $xmlItem){
                                                var_dump($xmlItem->title);
                                                var_dump($xmlItem->description);
                                                $xmlItem->description = preg_replace("/\<img.*\>/","",$xmlItem->description);
                                                
                                                $slider[$slot].='
                                                <div class="'.$slot.'-slider '.$slot.'-slide rss fade">
                                                    <h4>'.$xmlItem->title.'</h4>
                                                    <p>'.self::substrwords($xmlItem->description, 450, '.').'</p>
                                                    <small>'.date('d.m.Y - H:i', strtotime($xmlItem->pubDate)).'</small>
                                                </div>';
                                            }
                                        }
                                    }
                                    else if($object->getType() == 'weather'){
                                        $xml = simplexml_load_file ($object->getLink());
                                        if($xml){
                                            foreach($xml->channel->item as $xmlKeys => $xmlItem){
                                                $slider[$slot].='
                                                <div class="'.$slot.'-slider '.$slot.'-slide rss fade center">
                                                    <h4>Das Wetter in '.$xmlItem->ort.'</h4>
                                                    <div class="center"><img src="'.$xmlItem->wetter_icon.'" width="250"></div>
                                                    <h3>'.$xmlItem->wetter_text.'</h3>
                                                    <small>Zuletzt aktualisiert um '.date('H:i', strtotime($xmlItem->pubDate)).' Uhr</small>
                                                </div>';
                                            }   
                                        }
                                    } 
                                }
                            }
                        }
                    break;
                    case 'multimedia': // Multimedia template
                        if(is_array($objectArray)){
                            foreach($objectArray as $key => $object){    
                                if(strtotime($object->getStartDate()) < time() && strtotime($object->getEndDate()) > time()){
                                    if(substr($object->getType(), 0, 5) == 'image'){
                                        $slider[$slot].='
                                        <div class="'.$slot.'-slider '.$slot.'-slide fade image">
                                            <img src="/layout/media/upload/'.$object->getName().'" style="width:100%">
                                        </div>';
                                    }
                                    else if($object->getType() == 'video/mp4'){
                                        if(file_exists(getcwd().'/layout/media/upload/'.$object->getName())){                                          
                                            $fileMeta = $getID3->analyze(getcwd().'/layout/media/upload/'.$object->getName());
                                            $vidDuration = round($fileMeta['playtime_seconds']*1000);                                           
                                        }
                                        $slider[$slot].='
                                        <div class="'.$slot.'-slider '.$slot.'-slide fade video">
                                            <video data-duration="'.$vidDuration.'" width="100%" autoplay="" id="werbe-video" type="video/mp4" loop="" muted="" playsinline="" src="//'.$_SERVER["HTTP_HOST"].'/layout/media/upload/'.$object->getName().'">
                                                <source src="" type="video/mp4">
                                            </video>
                                        </div>';
                                    } 
                                }
                            }
                        }
                    break;
                    case 'default': break;
                }
            }
            $slider[$slot].='  </div>';
        }
        return $slider;
    }
}