<?php

namespace app\models\entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use app\config\Settings;


/**
 * @ORM\Entity
 * @ORM\Table(name="screens")
 */
class Screen {
    
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    public $id;
     /** 
     * @ORM\Column(type="string") 
     */
    public $name;
     /** 
     * @ORM\Column(type="string") 
     */
    public $mode;
     /** 
     * @ORM\Column(type="string", nullable=true) 
     */
    public $slots;
     /** 
     * @ORM\Column(type="integer") 
     */
    public $online;
    /** 
     * @ORM\Column(type="string", nullable=true) 
     */
    public $token;
    

    // /**
    //  * @ORM\JoinTable(name="screen_package",
    //  * joinColumns={@ORM\JoinColumn(name="package_id", referencedColumnName="id")},
    //  * inverseJoinColumns={@ORM\JoinColumn(name="screen_id", referencedColumnName="id")})                         
    //  */
    // private $package;

    function __construct(string $name, string $mode, string $token,int $online = 0){
        $this->name = $name;
        $this->token = $token;
        $this->online = $online;
        self::setMode($mode);
        $this->package= new ArrayCollection();
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setName(string $name) {
        $this->name = $name;
    }

    function getMode() {
        return $this->mode;
    }

    function setMode(string $mode) {
        if(in_array($mode,Settings::SCREEN_MODE_TYPES)) {
            $this->mode = $mode;
        } else {
            //Error
        }
    }

    function addPackages(string $id, Package $package) {
        if(isset($id) && is_object($package)) {
            $this->package[$id] = $package;
        }
    }

    function removePackages(string $name) {
        if(isset($name)) {
            unset($this->package[$name]);
        }
    }

    function setSlots(string $slots) {
        $this->slots = $slots;
    }

    function getSlots() {
        return $this->slots;
    }

    function setToken(string $token) {
        $this->token = $token;
    }

    function getToken() {
        return $this->token;
    }

    function setOnline(string $online) {
        $this->online = $online;
    }
    
    function getOnline() {
        return $this->online;
    }
}