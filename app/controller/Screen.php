<?php 

namespace app\controller;

use app\core\Basecontroller;
use app\core\App;

class Screen extends Basecontroller {   

    /* 
    * inital call function
    */
    function index() {
        if(isset($_POST['delete-screen'])){
            $data = $this->screen->delete($_POST['delete-screen']);
        }
        $data["screens"] = $this->screen->loadAll("Screen");
        $this->view->generateTpl('screen', 'Screen', $data);
    }

    /* 
    * create author function
    */
    function new() {
       
        $data = array();
        if(isset($_POST["submit_new"])) {
            $screen = $this->screen->create($_POST["screen_name"], $_POST["mode"]);
            if($screen){
                $data['message'] = $this->message->setMessage('success', 'Bildschirm wurde erfolgreich erstellt');
            }else{
                $data['message'] = $this->message->setMessage('error', 'Bildschrirm konnte nicht erstellt werden');
            }
        }
        $this->view->generateTpl("screen_new", 'Screen', $data);
    }

    /*
    * import a csv file with author data
    */
    function import() {
        if(isset($_POST["author_submit"])) {   
            if(isset($_FILES['author_csv']['size']) && ($_FILES['author_csv']['size'] > 0)){
                $data = $this->author->import($_FILES['author_csv']);
            }else{
                $data['message'] = $this->message->setMessage('error', 'Es wurde keine CSV Datei ausgewählt');
            }
      
            $this->view->generateTpl("author_import", 'Screen',$data);  
        }
        $this->view->generateTpl("author_import",'Screen');  
    }
    /* 
    * modify author object function
    */
    function edit(int $id = 0) {   
        if(isset($_POST["save"])){
            $data = $this->screen->edit($_POST, $id);
        }
        $data["packages"] = $this->screen->loadAll("Package");
        $data["screen"] = $this->screen->load("Screen",$id);
        
        $mapping = $this->screenPackageMapping($data["screen"], $data["packages"]);
        if(isset($mapping[0]) && $mapping[0] != ''){
            $data["packages"] =  $mapping[1];
            $data["selected_packages"] = $mapping[0];
        }
        $this->view->generateTpl("screen_edit", 'Screen', $data);
    }

    function show($token) {
        $data = $this->screen->loadByToken($token);

        if($data['screen'][0]->getOnline() != 1){
            $data['message'] = $this->message->setMessage('error', 'Der Screen ist aktuell offline');
            $this->view->generateTpl('screen_offline', 'Screen', $data);
        }else{
            $data = $this->screen->loadByToken($token);
            $data["packages"] = $this->screen->loadAll("Package");
            $mapping = $this->screenPackageMapping(false, $data["packages"], $data["screen"][0]->getSlots());
            if(isset($mapping[0]) && $mapping[0] != ''){
                $data["packages"] =  $mapping[1];
                $data["selected_packages"] = $mapping[0];
            }

            foreach($data['selected_packages'] as $slot => $packages){
                foreach($packages as $package){
                    if(is_array($package->getAuthorIds())){
                        foreach($package->getAuthorIds() as $id){
                            $data['ressources'][$slot]['authors'][] = $this->author->load('Author', $id);
                        }
                    }
                    if(is_array($package->getMultimediaIds())){
                        foreach($package->getMultimediaIds() as $id){
                            $data['ressources'][$slot]['multimedia'][] = $this->author->load('Multimedia', $id);
                        }
                    }
                    if(is_array($package->getRssIds())){
                        foreach($package->getRssIds() as $id){
                            $data['ressources'][$slot]['rss'][] = $this->author->load('Rss', $id);
                        }
                    }
                } 
            }
            unset($data["selected_packages"]);

            if($data['ressources']){
                $data['slider'] = \App\Core\Slider::buildSlider($data['ressources']);
            } 
   
            switch($data['screen'][0]->getMode()){
                case 'one_screen': $this->view->generateTpl("screen_frontend_full", 'Screen', $data, true); break;
                case 'four_divided': $this->view->generateTpl("screen_frontend_four_divided", 'Screen', $data, true); break;
                default: $this->view->generateTpl("screen_frontend_four_divided", 'Screen', $data, true); break;
            }

            
        }
    }

    function screenPackageMapping($screen, $packages, $slotString = false){
        $selectedPackages = array();

       
        if($screen != false || $slotString != false){
            if($slotString){
                $slotString = explode(';', $slotString);
            }else{
                if($screen->getSlots() != ''){
                    $slotString = explode(';', $screen->getSlots());
                }else{
                    return false;
                }
                
            }

            foreach($slotString as $key => $slotMatching){
                $key = explode(':', $slotMatching)[0];
    
                if($key != ''){
                    $slots[$key] = explode(':', $slotMatching)[1];
                }
            }
            if(!empty($slots)) {
                foreach($slots as $slotKey => $slot){
                    foreach(explode(',', $slot) as $key => $selectedPackageIds){
                        
                        foreach($packages as $pKey => $value) {
                            if($value->getId() == $selectedPackageIds){
                                $selectedPackages[$slotKey][] = $packages[$pKey];                 
                                unset($packages[$pKey]);    
                            }
                        }
                        $slot[$key] =  $selectedPackageIds;
                    }
                }
            }

        }
        return [$selectedPackages, $packages];
    }

    
}