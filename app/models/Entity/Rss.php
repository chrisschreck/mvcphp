<?php

namespace app\models\entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use app\config\Settings;


/**
 * @ORM\Entity
 * @ORM\Table(name="rss_feeds")
 */
class Rss  {


    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
     /** 
     * @ORM\Column(type="string") 
     */
    public $naaame;

    /** 
     * @ORM\Column(type="string") 
     */
    public $link;

    /**
     * @ORM\Column(type="string")
     */
    public $type;

    /** 
     * @ORM\Column(type="date", nullable=true) 
     */
    public $start_date;

    /** 
     * @ORM\Column(type="date", nullable=true) 
     */
    public $end_date;

    function __construct(string $name, string $link, string $type, $start_date = NULL, $end_date = NULL)
    {
        $this->name = $name;
        $this->link = $link;
        $this->type = $type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
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

    function getLink() {
        return $this->link;
    }

    function setLink(string $link) {
        $this->link = $link;
    } 

    function getStartDate() {
        if(!is_null($this->start_date)) {
            return $this->start_date->format("Y-m-d");
        }
    }

    function setStartDate($start_date) {
        $this->start_date = $start_date;
    }

    function getEndDate() {
        if(!is_null($this->end_date)) {
            return $this->end_date->format("Y-m-d");
        }
    }

    function setEndDate($end_date) {
        $this->end_date = $end_date;
    }

    function getType() {
        return $this->type;
    }


    function setType(string $type) {
        $this->type = $type;
    }

}